package com.cesaepulse.app.ui.views.admin.page

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material3.Card
import androidx.compose.material3.Divider
import androidx.compose.material3.HorizontalDivider
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.TextUnit
import androidx.compose.ui.unit.TextUnitType
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavHostController
import coil.compose.AsyncImage
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.ui.components.InfoHours.InfoHour
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun AdminUsersPage(
	navController: NavHostController,
	viewModel: UsersPageViewModel = hiltViewModel(),
	id: Int
) {
	LaunchedEffect(key1 = true) {
		viewModel.fetchUser(id)
	}

	val profile by viewModel.profile.collectAsStateWithLifecycle()
	val hoursDay by viewModel.hoursDay.collectAsStateWithLifecycle()
	val hoursWeek by viewModel.hoursWeek.collectAsStateWithLifecycle()
	val hoursMonth by viewModel.hoursMonth.collectAsStateWithLifecycle()
	val lastPresence by viewModel.lastPresence.collectAsStateWithLifecycle()
	val faults by viewModel.faults.collectAsStateWithLifecycle()

	Card(
		modifier = Modifier
			.fillMaxSize()
			.padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
	) {
		Column(
			verticalArrangement = Arrangement.spacedBy(8.dp),
			modifier = Modifier
				.fillMaxSize()
				.padding(15.dp)
		) {
			Row(
				horizontalArrangement = Arrangement.SpaceEvenly,
				verticalAlignment = Alignment.CenterVertically
			){
				AsyncImage(
					model = profile?.foto ?: (CesaePulseApi.urlImage + "defaultUserBack.png"),
					contentDescription = profile?.name,
					modifier = Modifier
						.padding(vertical = 20.dp)
						.size(136.dp)
						.clip(Shapes.small),
					contentScale = ContentScale.Crop,
				)
				Column(
					modifier = Modifier.padding(start = 20.dp)
				) {
					Text(
						text = profile?.name ?: "Nome",
						fontSize = TextUnit(30f, TextUnitType.Sp),
						fontWeight = FontWeight.Bold)
					Text(text = "Ultima Entrada: $lastPresence")
				}
			}
			Text(text = "Horas", fontSize = TextUnit(25f, TextUnitType.Sp), fontWeight = FontWeight.Bold)
			HorizontalDivider(thickness = 2.dp)
			Row(
				horizontalArrangement = Arrangement.spacedBy(20.dp),
				modifier = Modifier.padding(vertical = 10.dp)
			) {
				InfoHour(
					header = "Diárias",
					hour = "${hoursDay}h",
					color = MaterialTheme.colorScheme.primary,
					colorText = MaterialTheme.colorScheme.onPrimary)
				InfoHour(
					header = "Semanais",
					hour = "${hoursWeek}h",
					color = MaterialTheme.colorScheme.secondary,
					colorText = MaterialTheme.colorScheme.onSecondary)
				InfoHour(
					header = "Mensais",
					hour = "${hoursMonth}h",
					color = MaterialTheme.colorScheme.tertiary,
					colorText = MaterialTheme.colorScheme.onTertiary)
			}
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
						text = "Dia",
						modifier = Modifier.weight(1f),
						textAlign = TextAlign.Center,
						color = Color.White
					)
					Text(
						text = "Status",
						modifier = Modifier.weight(1f),
						textAlign = TextAlign.Center,
						color = Color.White
					)
					Text(
						text = "Horário",
						modifier = Modifier.weight(1f),
						textAlign = TextAlign.Center,
						color = Color.White
					)
				}

				Divider(color = Color.Black, thickness = 1.dp)

				// LazyColumn para exibir os dados dos dias de falta
				LazyColumn(modifier = Modifier.fillMaxSize()) {
					items(faults.size) { index ->
						Row(
							modifier = Modifier
								.fillMaxWidth()
								.padding(vertical = 8.dp),
							horizontalArrangement = Arrangement.SpaceBetween
						) {
							Text(
								text = faults[index]?.date ?: "00/00/00",
								modifier = Modifier.weight(1f),
								textAlign = TextAlign.Center
							)
							Text(
								text = faults[index]?.entry_time ?: "00:00:00",
								modifier = Modifier.weight(1f),
								textAlign = TextAlign.Center,
								color = Color.Red
							)
							Text(
								text = (if(faults[index]?.attendance_mode?.id == 1) "Online" else "Presencial"),
								modifier = Modifier.weight(1f),
								textAlign = TextAlign.Center
							)
						}
						Divider(color = Color.LightGray, thickness = 1.dp)
					}
				}
			}
		}
	}
}