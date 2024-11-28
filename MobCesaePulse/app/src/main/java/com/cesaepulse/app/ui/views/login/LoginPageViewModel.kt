package com.cesaepulse.app.ui.views.login

import android.util.Log
import androidx.compose.foundation.text.input.TextFieldState
import androidx.compose.ui.text.capitalize
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

    private var _error = MutableStateFlow<String?>(null)
    val error = _error.asStateFlow()

    // Mock credentials
    private val mockCredentials = mapOf(
        "joana@cesae.pt" to "123fab",
        "fabio@cesae.pt" to "123fab",
        "test@cesae.pt" to "test"
    )

    fun setEmail(newEmail: String) {
        _email.value = newEmail
        // Clear any previous error when email changes
        _error.value = null
    }

    fun setPassword(newPassword: String) {
        viewModelScope.launch {
            _password.update { TextFieldState(newPassword) }
            // Clear any previous error when password changes
            _error.value = null
        }
    }

    fun ckeckLogin() {
        viewModelScope.launch {
            try {
                val email = _email.value
                val password = _password.value.text

                if (email.isBlank() || password.isBlank()) {
                    _error.value = "Please enter both email and password"
                    return@launch
                }

                // Check mock credentials
                if (mockCredentials[email] == password) {
                    _isLogged.value = true
                    _user.value = User(
                        id = 16,
                        name = "${email.split("@")[0].capitalize()}",
                        email = email,
                        foto = "uploadedImages/rxbAqvWZQqWvFcOxXgJYPgDw1IhebfcSlzaL79GP.png",
                        users_type_id = 1,
                        setor = "Laravel"
                    )
                    Log.d("Mock Login", "Login successful for $email")
                } else {
                    _error.value = "Invalid email or password"
                    Log.d("Mock Login", "Login failed for $email")
                }
            } catch (e: Exception) {
                _error.value = e.message ?: "An unexpected error occurred"
                Log.e("Mock Login", "Error: ${e.message}")
            }
        }
    }

    fun changePasswordVisibility() {
        _showPassword.update { !showPassword.value }
    }
}