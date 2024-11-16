package com.cesaepulse.app.ui.views.login

import androidx.lifecycle.ViewModel
import com.cesaepulse.app.data.mockRepositories.MockUserRepo
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import javax.inject.Inject

@HiltViewModel
class LoginPageViewModel @Inject constructor(
	private val repository: MockUserRepo
)  : ViewModel() {

	private val _email = MutableStateFlow("")
	var email = _email.asStateFlow()

	private val _password = MutableStateFlow("")
	var password = _password.asStateFlow()

	fun setEmail(newEmail: String) {
		_email.value = newEmail
	}

	fun setPassword(newPassword: String) {
		_password.value = newPassword
	}
}