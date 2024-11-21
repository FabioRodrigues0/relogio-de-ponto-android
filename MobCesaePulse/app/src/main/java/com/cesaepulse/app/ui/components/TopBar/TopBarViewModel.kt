package com.cesaepulse.app.ui.components.TopBar

import androidx.lifecycle.ViewModel
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import javax.inject.Inject

@HiltViewModel
class TopBarViewModel @Inject constructor(

): ViewModel() {
	private val _menuExpanded = MutableStateFlow<Boolean>(false)
	val menuExpanded = _menuExpanded.asStateFlow()



	fun toggleMenu() {
		_menuExpanded.value = !_menuExpanded.value
	}


}