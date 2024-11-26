package com.cesaepulse.app.ui.views.home

import androidx.lifecycle.ViewModel
import com.cesaepulse.app.data.repository.UserRepository
import com.cesaepulse.app.domain.model.User
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import javax.inject.Inject

@HiltViewModel
class HomePageViewModel @Inject constructor(
	private val repository: UserRepository
)  : ViewModel() {

	private var _user = MutableStateFlow<User?>(null)
	val user = _user.asStateFlow()

	fun onCheckIn(id: Int, type: Int){

	}

	fun onCheckOut(id: Int){

	}
}