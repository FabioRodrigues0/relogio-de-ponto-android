package com.cesaepulse.app.ui.views.calendar

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.repository.IScheduleRepository
import com.cesaepulse.app.ui.views.calendar.models.WorkDay
import com.cesaepulse.app.ui.views.calendar.models.WorkType
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import java.time.LocalDateTime.now
import javax.inject.Inject


@HiltViewModel
class CalendarViewModel @Inject constructor(
	private val repository: IScheduleRepository
) : ViewModel() {

	val list = listOf(
		"", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
		"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
	)
	val titles = listOf("Mensal", "Semanal")

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

	private val _listWorkDays = MutableStateFlow<ArrayList<WorkDay>>(arrayListOf())
	var listWorkDays = _listWorkDays.asStateFlow()

	fun updateState(index: Int) {
		viewModelScope.launch {
			_state.update { index }
		}
	}

	fun changeSelectedText(newMonth: String) {
		viewModelScope.launch {
			_monthSelect.update { newMonth }
			_monthSelectIndex.update { list.indexOf(newMonth) }
		}
	}

	fun changeExpanded() {
		viewModelScope.launch {
			_calendarExpanded.update { !_calendarExpanded.value }
		}
	}

	fun checkWorkDays() {
		// create list of WorkDay
		val type = WorkType.entries.toTypedArray()
		viewModelScope.launch {
			for (i in 1..5) {
				_listWorkDays.value.add(WorkDay("$i", 8, 10, "Aula $i", type.random()))
			}
		}
	}

	init {

	}
}