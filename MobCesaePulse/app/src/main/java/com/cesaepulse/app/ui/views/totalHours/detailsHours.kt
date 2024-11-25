package com.cesaepulse.app.ui.views.totalHours

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
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp

@Composable
fun TimeTable(
    timeEntries: List<TimeEntry>
) {
    Column(modifier = Modifier
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
                modifier = Modifier.weight(1f).padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
            Text(
                text = "Horas",
                modifier = Modifier.weight(1f).padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
            Text(
                text = "Resultado",
                modifier = Modifier.weight(1f).padding(8.dp),
                textAlign = TextAlign.Center,
                color = Color.White // Cor do texto para o cabeçalho
            )
        }

        // Linha de separação entre o cabeçalho e os dados
        Divider(modifier = Modifier.padding(vertical = 1.dp))

        // LazyColumn para tornar a tabela rolável
        LazyColumn(modifier = Modifier.fillMaxSize()) {
            // Iterando sobre a lista de entradas
            items(timeEntries.size) { index ->
                val entry = timeEntries[index]
                Row(
                    modifier = Modifier
                        .fillMaxWidth()
                        .padding(8.dp),
                    horizontalArrangement = Arrangement.SpaceEvenly
                ) {
                    Text(text = entry.date, modifier = Modifier.weight(1f), textAlign = TextAlign.Center)
                    Text(text = entry.hours.toString(), modifier = Modifier.weight(1f), textAlign = TextAlign.Center)
                    Text(
                        text = checkTime(entry.hours),
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

// Função para verificar se o tempo ultrapassou o limite
fun checkTime(hours: Double): String {
    return when {
        hours >= 7 -> "Ultrapassou" // Se as horas são acima de 7, é mais de 95%
        hours in 5.25..6.65 -> "75% a 95%" // Se as horas estão entre 75% (5.25h) e 95% (6.65h) de 7 horas
        hours > 6 -> "Acima 50%" // Se as horas são maiores que 6, mas menores que 7
        else -> "No limite" // Se as horas são menores que 6
    }
}

data class TimeEntry(
    val date: String,
    val hours: Double
)

@Preview(showBackground = true)
@Composable
fun PreviewTimeTable() {
    val timeEntries = listOf(
        TimeEntry("2024-11-25", 9.53),
        TimeEntry("2024-11-24", 6.03),
        TimeEntry("2024-11-23", 5.8),
        TimeEntry("2024-11-22", 9.53),
        TimeEntry("2024-11-21", 6.03),
        TimeEntry("2024-11-20", 5.8),
        TimeEntry("2024-11-19", 9.53),
        TimeEntry("2024-11-18", 6.03),
        TimeEntry("2024-11-17", 5.8),
        TimeEntry("2024-11-16", 6.50),
        TimeEntry("2024-11-15", 5.8),
        TimeEntry("2024-11-14", 9.53),
        TimeEntry("2024-11-13", 6.03),
        TimeEntry("2024-11-12", 8.0),
        TimeEntry("2024-11-11", 8.50),
        TimeEntry("2024-11-10", 6.20),
        TimeEntry("2024-11-09", 7.0),
    )
    TimeTable(timeEntries = timeEntries)
}
