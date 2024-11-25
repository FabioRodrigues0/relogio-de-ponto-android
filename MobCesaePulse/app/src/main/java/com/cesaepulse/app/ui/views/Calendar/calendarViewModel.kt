package com.cesaepulse.app.ui.views.Calendar

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.launch
import java.time.LocalDate
import java.time.YearMonth
import javax.inject.Inject

@HiltViewModel
class calendarViewModel @Inject constructor(
) : ViewModel() {
    val list = listOf(
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    )

    private var _monthSelect = MutableStateFlow<String>(list[0])
    val monthSelect = _monthSelect.asStateFlow()

    private var _monthSelectIndex = MutableStateFlow<Int>(0)
    val monthSelectIndex = _monthSelectIndex.asStateFlow()

    private val _calendarExpanded = MutableStateFlow<Boolean>(false)
    val calendarExpanded = _calendarExpanded.asStateFlow()

    fun changeSelectedText(newMonth: String) {
        _monthSelect.value = newMonth
    }

    fun changeExpanded() {
        _calendarExpanded.value = !_calendarExpanded.value
    }

    data class WorkDay(
        val day: String,
        val beginHour: Int,
        val endHour: Int,
        val eventDescription: String? = null,
        val workType: WorkType,
    )

    private val _listWorkDays = MutableStateFlow<ArrayList<WorkDay>>(arrayListOf())
    val listWorkDays = _listWorkDays.asStateFlow()

    fun checkWorkDays() {
        // create list of WorkDay
        val type = WorkType.entries.toTypedArray()
        viewModelScope.launch {
            for (i in 1..5) {
                _listWorkDays.value.add(WorkDay("$i", 8, 10, "Aula $i", type.random()))
            }
        }
    }
}

enum class WorkType(val value: String) {
    ONLINE("ONLINE"),
    OFFICE("OFFICE")
}

data class CalendarDay(
    val date: LocalDate,
    val isCurrentMonth: Boolean,
    val hasEvent: Boolean = false,
    val eventDescription: String? = null
)

data class CalendarMonth(
    val year: Int,
    val month: Int,
    val days: List<CalendarDay>
)


//@Composable
//fun CalendarScreen(viewModel: calendarViewModel = hiltViewModel()) {
//    val calendarMonth by viewModel.monthSelectIndex.collectAsState()
//
//    Calendar(
//        calendarMonth = calendarMonth,
//        onDayClick = { day ->
//            if (day.hasEvent) {
//                println("Evento: ${day.eventDescription}")
//            } else {
//                println("Dia: ${day.date}")
//            }
//        }
//    )
//}



fun generateCalendarMonth(
    year: Int,
    month: Int,
    events: Map<LocalDate, String>
): CalendarMonth {
    val currentMonth = YearMonth.of(year, 11)
    val daysInMonth = currentMonth.lengthOfMonth()
    val firstDayOfMonth = currentMonth.atDay(1)
    val dayOfWeek = firstDayOfMonth.dayOfWeek.value % 7

    val days = mutableListOf<CalendarDay>()

    for (i in 0 until dayOfWeek) {
        days.add(
            CalendarDay(
                date = firstDayOfMonth.minusDays((dayOfWeek - i).toLong()),
                isCurrentMonth = false
            )
        )
    }

    for (day in 1..daysInMonth) {
        val date = currentMonth.atDay(day)
        val hasEvent = events.containsKey(date)
        days.add(
            CalendarDay(
                date = date,
                isCurrentMonth = true,
                hasEvent = hasEvent,
                eventDescription = events[date]
            )
        )
    }

    while (days.size % 7 != 0) {
        days.add(
            CalendarDay(
                date = firstDayOfMonth.plusDays((days.size - dayOfWeek).toLong()),
                isCurrentMonth = false
            )
        )
    }

    return CalendarMonth(year = year, month = month, days = days)
}
