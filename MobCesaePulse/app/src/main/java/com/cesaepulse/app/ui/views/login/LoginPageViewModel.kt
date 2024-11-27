package com.cesaepulse.app.ui.views.login

import androidx.compose.foundation.text.input.TextFieldState
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.data.mockRepositories.MockUserRepo
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class LoginPageViewModel @Inject constructor(
	private val repository: IUserRepository
)  : ViewModel() {

	private var _usersList = MutableStateFlow<List<User>>(emptyList())
	val usersList = _usersList.asStateFlow()

	private val _email = MutableStateFlow("")
	var email = _email.asStateFlow()

	private val _password = MutableStateFlow<TextFieldState>(TextFieldState(""))
	var password = _password.asStateFlow()

	private val _isLogged = MutableStateFlow(false)
	var isLogged = _isLogged.asStateFlow()

	private val _showPassword = MutableStateFlow(false)
	var showPassword= _showPassword.asStateFlow()

	private val _user = MutableStateFlow<User?>(null)
	var user = _user.asStateFlow()

	fun setEmail(newEmail: String) {
		_email.value = newEmail
	}

	fun setPassword(newPassword: String) {
		viewModelScope.launch {
			_password.update { TextFieldState(newPassword) }
		}
	}

	fun ckeckLogin(){
		viewModelScope.launch {
			_user.update {
				usersList.value.first { user -> user.email == email.value }
			}
			if(_user.value != null){
				_isLogged.update { true }
			}
		}
	}

	fun changePasswordVisibility(){
		_showPassword.update { !showPassword.value }
	}
}