package com.cesaepulse.app.ui.views.calendar

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.model.Schedule
import com.cesaepulse.app.domain.repository.IScheduleRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import java.text.SimpleDateFormat
import java.time.Instant
import java.time.LocalDateTime.now
import javax.inject.Inject
import kotlin.collections.filter


@HiltViewModel
class CalendarViewModel @Inject constructor(
	private val repository: IScheduleRepository
) : ViewModel() {

	val list = listOf(
		"", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
		"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
	)
	val titles = listOf("Mensal", "Detalhes")

	private val _state = MutableStateFlow<Int>(0)
	var state = _state.asStateFlow()

	var currentYear = now().year
	private var currentMonth = now().month.value

	private val _monthSelect = MutableStateFlow<String>(list[currentMonth])
	var monthSelect = _monthSelect.asStateFlow()

	private val _monthSelectIndex = MutableStateFlow<Int>(currentMonth)
	var monthSelectIndex = _monthSelectIndex.asStateFlow()

	private val _calendarExpanded = MutableStateFlow<Boolean>(false)
	var calendarExpanded = _calendarExpanded.asStateFlow()

	private val _listWorkDays = MutableStateFlow<List<Schedule?>>(arrayListOf())
	var listWorkDays = _listWorkDays.asStateFlow()

	private val _schedules = MutableStateFlow<List<Schedule?>>(arrayListOf())
	var schedules = _schedules.asStateFlow()

	private val _openDialog = MutableStateFlow<Boolean>(false)
	var openDialog = _openDialog.asStateFlow()

	private val _selectedCard = MutableStateFlow<Int>(0)
	var selectedCard = _selectedCard.asStateFlow()

	fun updateState(index: Int) {
		viewModelScope.launch {
			_state.update { index }
		}
	}

	fun changeSelectedCard(index: Int) {
		viewModelScope.launch {
			_selectedCard.update { index }
		}
	}

	fun changeSelectedText(newMonth: String) {
		viewModelScope.launch {
			_monthSelect.update { newMonth }
			_monthSelectIndex.update { list.indexOf(newMonth) }
		}
	}

	fun changeOpenDialog() {
		viewModelScope.launch {
			_openDialog.update { !_openDialog.value }
		}
	}

	fun changeExpanded() {
		viewModelScope.launch {
			_calendarExpanded.update { !_calendarExpanded.value }
		}
	}

	fun checkWorkDays() {
		viewModelScope.launch {
			val formatWeek: SimpleDateFormat = SimpleDateFormat("WW");
				_listWorkDays.update {
					_schedules.value.filter{ shedules ->
						formatWeek.parse(shedules?.created_at) == formatWeek.parse(Instant.now().toString().split('T')[0])
					}
				}
		}
	}

	init {
		viewModelScope.launch {
			_schedules.update { repository.getSchedulesById(16, monthSelectIndex.value) }
		}
	}
}