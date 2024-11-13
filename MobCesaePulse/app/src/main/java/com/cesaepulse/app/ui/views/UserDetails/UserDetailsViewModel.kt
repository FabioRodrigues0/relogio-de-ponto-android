package com.cesaepulse.app.ui.views.UserDetails

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
class UsersDetailsViewModel @Inject constructor(
    private val repository: MockUserRepo
)  : ViewModel() {
    //private val repository: UserRepository
    // trocar depois o MockUserRepo por UserRepository
    private var _users = MutableStateFlow<User?>(null)
    val user = _users.asStateFlow()

    fun fetchUser(id: Int) {
        viewModelScope.launch {
            _users.update { repository.getUserById(id) }
        }
    }

}