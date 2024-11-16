package com.cesaepulse.app.ui.views.home

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.data.mockRepositories.MockUserRepo
import com.cesaepulse.app.domain.model.User
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class HomePageViewModel @Inject constructor(
	private val repository: MockUserRepo
)  : ViewModel() {
	//private val repository: UserRepository
	// trocar depois o MockUserRepo por UserRepository
	private var _user = MutableStateFlow<User?>(null)
	val user = _user.asStateFlow()

	fun fetchUser() {
		viewModelScope.launch {
			_user.update { repository.getUserById(1) }
		}
	}
}