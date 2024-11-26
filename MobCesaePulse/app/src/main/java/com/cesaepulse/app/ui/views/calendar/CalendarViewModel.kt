package com.cesaepulse.app.ui.views.Calendar

import androidx.lifecycle.ViewModel
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import java.time.LocalDate
import java.time.YearMonth
import javax.inject.Inject

@HiltViewModel
class calendarViewModel@Inject constructor(
)  : ViewModel(){
    val list = listOf(
        "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
    )

    private var _monthSelect= MutableStateFlow<String>(list[0])
    val monthSelect = _monthSelect.asStateFlow()

    private var _monthSelectIndex= MutableStateFlow<Int>(0)
    val monthSelectIndex = _monthSelectIndex.asStateFlow()

    private val _calendarExpanded = MutableStateFlow<Boolean>(false)
    val calendarExpanded = _calendarExpanded.asStateFlow()

    fun changeSelectedText(newMonth: String) {
        _monthSelect.value = newMonth
    }

    fun changeExpanded(){
        _calendarExpanded.value = !_calendarExpanded.value
    }
