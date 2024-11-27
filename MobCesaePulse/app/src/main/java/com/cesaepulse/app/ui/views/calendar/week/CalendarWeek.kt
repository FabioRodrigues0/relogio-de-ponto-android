package com.cesaepulse.app.ui.views.calendar.week

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.material3.AlertDialog
import androidx.compose.material3.Card
import androidx.compose.material3.CardDefaults
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavController
import com.cesaepulse.app.ui.views.Calendar.dialog.CalendarDayDetails
import com.cesaepulse.app.ui.views.calendar.CalendarViewModel
import com.cesaepulse.app.ui.views.calendar.models.WorkType
import java.text.SimpleDateFormat

@Composable
fun CalendarWeek(
	navController: NavController,
	 viewModel: CalendarViewModel = hiltViewModel(),
) {

	//cards dos dias da semana
	viewModel.checkWorkDays()
	val cardTexts by viewModel.listWorkDays.collectAsStateWithLifecycle()
	val selectedText by viewModel.monthSelect.collectAsStateWithLifecycle()
	val schedulers by viewModel.schedules.collectAsStateWithLifecycle()

	// Estado para controlar se a caixa de diálogo está aberta
	val openDialog = remember { mutableStateOf(false) }
	// Estado para o número do card selecionado
	val selectedCard = remember { mutableStateOf(0) }

	LazyColumn(
		modifier = Modifier
			.fillMaxWidth()
			.padding(16.dp), // Padding geral ao redor dos cartões
		verticalArrangement = Arrangement.spacedBy(6.dp) // Espaçamento entre os cartões
	) {
		items(cardTexts.size) { i ->
			Card(
				modifier = Modifier
					.fillMaxWidth()
					.padding(8.dp) // Padding individual do cartão
					.clickable { // Adiciona a ação de clique
						selectedCard.value = i // Definir o número do card selecionado
						openDialog.value = true // Abre o Dialog
					}, elevation = CardDefaults.cardElevation(5.dp) // Elevação ajustada
			) {
				Row(
					modifier = Modifier
						.fillMaxWidth()
						.padding(20.dp), // Tamanho do card
					verticalAlignment = Alignment.CenterVertically
				) {
					// Círculo para o número
					Box(
						modifier = Modifier
							.size(20.dp)
							.background(Color(0xFFE0E0FF), CircleShape), // Cor e forma circular
						contentAlignment = Alignment.Center
					) {
						Text(
							text = schedulers[i]?.created_at.toString().split("-")[2],
							color = Color(0xFF000000),
							style = MaterialTheme.typography.bodyMedium
						)
					}

					Spacer(modifier = Modifier.width(20.dp)) // Espaço entre o círculo e o texto

					Text(
						text = selectedText, //mes
						style = MaterialTheme.typography.bodyLarge,
						modifier = Modifier.weight(1f) // Faz o texto ocupar o espaço restante
					)

					// Quadrado verde
					Box {
						Column(modifier = Modifier.size(50.dp)) {
							Text(
								text = "Manha",
								color = if(cardTexts[i]?.attendance_mode_id == 1) Color.Green else Color.Blue,
								modifier = Modifier
									.background(if (cardTexts[i]?.attendance_mode_id == 1) Color.Green else Color.Blue)
									.weight(1f) // Faz o texto ocupar o espaço restante
							)
							if(cardTexts[i]?.afternoon_exit_time != "17:00:00"){
								Text(
									text = "Tarde",
									color = if(cardTexts[i]?.attendance_mode_id == 1) Color.Green else Color.Blue,
									modifier = Modifier
										.background(if (cardTexts[i]?.attendance_mode_id == 1) Color.Green else Color.Blue)
										.weight(1f) // Faz o texto ocupar o espaço restante
								)
							}
						}
					}
				}
			}
		}
	}

	// Caixa de diálogo que aparece quando openDialog é true
	if (openDialog.value) {
		AlertDialog(onDismissRequest = {
			openDialog.value = false
		}, // Fecha o Dialog ao tocar fora
			title = {
				Text(text = "${schedulers[selectedCard.value]?.created_at.toString().split(" ")[0].split('-')[2]} de $selectedText") // Título do Dialog
			}, text = {
				// Exibe o texto correspondente ao card selecionado
				CalendarDayDetails(cardTexts[selectedCard.value])// Texto diferente para cada card
			}, confirmButton = {
				TextButton(onClick = { openDialog.value = false }) {
					Text("Fechar")
				}
			})
	}
}
