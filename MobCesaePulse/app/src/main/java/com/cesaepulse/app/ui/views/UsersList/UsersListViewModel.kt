package com.cesaepulse.app.ui.views.UsersList

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.data.repository.UserRepository
import com.cesaepulse.app.domain.model.User
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class UsersListViewModel @Inject constructor(
	private val repository: UserRepository
)  : ViewModel() {

	private var _usersList = MutableStateFlow<List<User>>(emptyList())
	val usersList = _usersList.asStateFlow()

	init {
		viewModelScope.launch {
			_usersList.update {
				repository.getAllUsers()
			}
		}
	}
}