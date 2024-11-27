package com.cesaepulse.app.ui.views.profile.activity

import android.annotation.SuppressLint
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.lazy.items
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
import com.cesaepulse.app.domain.model.PresenceRecord
import com.cesaepulse.app.ui.views.profile.detailsHours.TimeEntry
import com.cesaepulse.app.ui.views.profile.page.UsersPageViewModel
import java.text.SimpleDateFormat

@SuppressLint("DefaultLocale")
@Composable
fun ProfileActivity(
    viewModel: UsersPageViewModel = hiltViewModel(),
) {
    val profile by viewModel.profile.collectAsStateWithLifecycle()
    val format: SimpleDateFormat = SimpleDateFormat("HH:mm:ss");


    Column(
        modifier = Modifier
            .fillMaxSize()
            .padding(top = 110.dp)
    ) {
        // Cabeçalho da Tabela
        Row(
            modifier = Modifier
                .fillMaxWidth()
                .background(Color.Gray)
                .padding(vertical = 8.dp)
        ) {
            Text(
                text = "dia",
                modifier = Modifier.weight(1f),
                textAlign = TextAlign.Center,
                color = Color.Black
            )
            Text(
                text = "tipo",
                modifier = Modifier.weight(1f),
                textAlign = TextAlign.Center,
                color = Color.Black
            )
            Text(
                text = "total",
                modifier = Modifier.weight(1f),
                textAlign = TextAlign.Center,
                color = Color.Black
            )
            Text(
                text = "Objetivo",
                modifier = Modifier.weight(1f),
                textAlign = TextAlign.Center,
                color = Color.Black
            )
        }

        // Linha de separação
        Divider(color = Color.Gray, thickness = 1.dp)

        // LazyColumn para exibir os dados
        LazyColumn(modifier = Modifier.fillMaxSize()) {
            if (profile?.presences != emptyList<PresenceRecord>()) {
                items(profile?.presences!!.size) { entry ->
                    Row(
                        modifier = Modifier
                            .fillMaxWidth()
                            .padding(vertical = 8.dp),
                        horizontalArrangement = Arrangement.SpaceBetween
                    ) {
                        Text(
                            text = profile!!.presences[entry].date,
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )
                        // Quadrado verde na coluna "tipo"
                        Box(
                            modifier = Modifier
                                .size(20.dp) // Tamanho do quadrado
                                .background(Color.Green) // Cor verde


                        )

                        Text(
                            text = String.format(
                                "%.2f",
                                profile?.presences?.map {
                                    // Convert entry_time and exit_time to milliseconds and calculate the difference
                                    format.parse(it.exit_time)
                                        .getTime() - format.parse(it.entry_time).getTime()
                                }?.reduce { sum, element ->
                                    sum + element
                                }?.toDouble() ?: 0.0 // Use 0.0 if the list is empty
                            ),
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )

                        Text(
                            text = String.format("%.2f", 8),
                            modifier = Modifier.weight(1f),
                            textAlign = TextAlign.Center
                        )
                    }

                    // Linha de separação entre os dados
                    Divider(color = Color.LightGray, thickness = 1.dp)
                }
            }
        }
    }
}
