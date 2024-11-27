package com.cesaepulse.app.ui.views.profile.detailsHours

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material3.Divider
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.domain.model.AttendanceMode
import com.cesaepulse.app.domain.model.PresenceRecord
import com.cesaepulse.app.ui.views.profile.page.UsersPageViewModel
import java.text.SimpleDateFormat
import java.util.Date

@Composable
fun DetailsHours(
    viewModel: UsersPageViewModel = hiltViewModel(),
) {
    val profile by viewModel.profile.collectAsStateWithLifecycle()

    Column(
        modifier = Modifier
            .fillMaxSize()
            .padding(top = 120.dp)
    ) {
        // Cabeçalho da Tabela
        Row(
            modifier = Modifier
                .fillMaxWidth()
                .padding(8.dp)
                .background(Color.Gray) // Cor de fundo para o cabeçalho
        ) {
            Text(
                text = "Data",
                modifier = Modifier
                    .weight(1f)
                    .padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
            Text(
                text = "Horas",
                modifier = Modifier
                    .weight(1f)
                    .padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
            Text(
                text = "Resultado",
                modifier = Modifier
                    .weight(1f)
                    .padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
        }

        // Linha de separação entre o cabeçalho e os dados
        Divider(modifier = Modifier.padding(vertical = 1.dp))

        // LazyColumn para tornar a tabela rolável
        LazyColumn(modifier = Modifier.fillMaxSize()) {
            // Iterando sobre a lista de entradas
            if (profile != null && profile!!.presences != emptyList<PresenceRecord>()) {
                items(profile!!.presences.size) { index ->

                    Row(
                        modifier = Modifier
                            .fillMaxWidth()
                            .padding(8.dp),
                        horizontalArrangement = Arrangement.SpaceEvenly
                    ) {
                        Text(
                            text = profile!!.presences[index].date,
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )
                        Text(
                            text = profile!!.presences[index].entry_time.toString(),
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )
                        Text(
                            text = checkTime(profile!!.presences[index]),
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )
                    }

                    // Linha de separação entre cada linha de dados
                    Divider(modifier = Modifier.padding(vertical = 4.dp))
                }
            }
        }
    }
}

// Função para verificar se o tempo ultrapassou o limite
fun checkTime(presence: PresenceRecord): String {
    var difference: Long = 0;
    val format: SimpleDateFormat = SimpleDateFormat("HH:mm:ss");
    val entry_time: Date = format.parse(presence.entry_time);
    if (presence.exit_time != null) {
        val exit_time: Date = format.parse(presence.exit_time);
        difference = exit_time.getTime() - entry_time.getTime();
    }
    return when {
        difference >= 7 -> "Ultrapassou" // Se as horas são acima de 7, é mais de 95%
        difference.toDouble() in 5.25..6.65 -> "75% a 95%" // Se as horas estão entre 75% (5.25h) e 95% (6.65h) de 7 horas
        difference > 6 -> "Acima 50%" // Se as horas são maiores que 6, mas menores que 7
        else -> "No limite" // Se as horas são menores que 6
    }
}

data class TimeEntry(
    val date: String,
    val hours: Double
)
