package com.cesaepulse.app.ui.views.user.list

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class UsersListViewModel @Inject constructor(
	private val repository: IUserRepository
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