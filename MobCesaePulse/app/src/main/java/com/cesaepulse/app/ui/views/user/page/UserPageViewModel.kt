package com.cesaepulse.app.ui.views.user.page

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
class UsersPageViewModel @Inject constructor(
    private val repository: UserRepository
)  : ViewModel() {

    private var _users = MutableStateFlow<User?>(null)
    val user = _users.asStateFlow()

    fun fetchUser(id: Int) {
        viewModelScope.launch {
            _users.update { repository.getUserById(id) }
        }
    }

}