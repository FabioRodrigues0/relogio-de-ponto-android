package com.cesaepulse.app.ui.views.calendar.month

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.grid.GridCells
import androidx.compose.foundation.lazy.grid.LazyVerticalGrid
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.HorizontalDivider
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.domain.model.Schedule
import com.cesaepulse.app.ui.theme.colorOffline
import com.cesaepulse.app.ui.theme.colorOnline
import com.cesaepulse.app.ui.views.calendar.CalendarViewModel
import com.cesaepulse.app.ui.views.calendar.dropdown.CalendarSelect
import java.text.SimpleDateFormat
import java.time.YearMonth

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun CalendarMonthScreen(
	viewModel: CalendarViewModel = hiltViewModel(),
) {
	var selectedText = viewModel.monthSelect.collectAsStateWithLifecycle()
	var monthSelectIndex = viewModel.monthSelectIndex.collectAsStateWithLifecycle().value
	val schedulers by viewModel.schedules.collectAsStateWithLifecycle()
	val currentYear = viewModel.currentYear
	val format: SimpleDateFormat = SimpleDateFormat("dd");

	val currentMonth = YearMonth.of(currentYear, monthSelectIndex)
	val daysInMonth = currentMonth.lengthOfMonth()
	val firstDayOfMonth = currentMonth.atDay(1)
	val dayOfWeek = firstDayOfMonth.dayOfWeek.value % 7

	fun checkWorkDays(day: Int): Schedule? {
		val date = format.parse("${currentYear}-${monthSelectIndex}-${day}")
		val scheduleDay = schedulers.filter { it ->  it?.created_at?.split(" ")[0] == date?.toString() }
		if (scheduleDay.isNotEmpty()) {
			return scheduleDay[0]
		}
		return null
	}

	Column(
		modifier = Modifier
			.fillMaxSize()
			.padding(top = 120.dp),
		verticalArrangement = Arrangement.Top
	) {
		//calendario mensal
		Column(
			modifier = Modifier
				.fillMaxSize()
				.padding(16.dp), // Padding opcional para garantir que o conteúdo não fique colado nas bordas
			horizontalAlignment = Alignment.CenterHorizontally,
			//verticalArrangement = Arrangement.
		) {

			CalendarSelect()
			Spacer(modifier = Modifier.height(25.dp)) // Espaço entre o título e o conteúdo

			// Cabeçalho com os dias da semana
			Row(
				modifier = Modifier.fillMaxWidth(),
				horizontalArrangement = Arrangement.SpaceAround // Distribui os dias igualmente
			) {
				listOf("Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab").forEach { day ->
					Text(
						text = day,
						style = MaterialTheme.typography.bodyMedium,
						textAlign = TextAlign.Center
					)
				}
			}

			Spacer(modifier = Modifier.height(5.dp)) // Espaço entre o cabeçalho e a grade de dias

			// Grid de dias do mês
			LazyVerticalGrid(
				columns = GridCells.Fixed(7), // 7 colunas para os 7 dias da semana
				content = {
					// Espaços vazios até o primeiro dia do mês
					items(dayOfWeek) {
						Text(
							text = "", // Espaços vazios
							modifier = Modifier.height(40.dp)
						)
					}

					// Dias do mês
					items(daysInMonth) { day ->
						Box(
							modifier = Modifier
								.height(40.dp)
								.fillMaxWidth()
								.padding(4.dp), // Espaçamento entre as células
							contentAlignment = Alignment.Center
						) {
							Column {
								Text(text = (day + 1).toString())
								val schedule = checkWorkDays(day + 1)
								if (schedule != null) {
									HorizontalDivider(
										thickness = 4.dp,
										color = if(schedule.attendance_mode_id == 1) colorOnline else colorOffline,
									)
								}
							}
						}
					}
				}
			)
		}
	}
}