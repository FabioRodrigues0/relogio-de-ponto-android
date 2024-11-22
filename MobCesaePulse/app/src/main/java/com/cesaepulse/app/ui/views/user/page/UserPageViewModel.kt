package com.cesaepulse.app.ui.views.user.page

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.repository.IProfileRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class UsersPageViewModel @Inject constructor(
    private val repository: IProfileRepository
)  : ViewModel() {

    private var _profile = MutableStateFlow<Profile?>(null)
    val profile = _profile.asStateFlow()

    fun fetchUser(id: Int) {
        viewModelScope.launch {
            _profile.update { repository.getProfileById(id) }
        }
    }

}