package com.cesaepulse.app.ui.views.home

import androidx.compose.ui.graphics.Color
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.repository.IProfileRepository
import com.cesaepulse.app.domain.repository.IUserRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class HomePageViewModel @Inject constructor(
	private val repositoryProfile: IProfileRepository,
	private val repositoryUser: IUserRepository
)  : ViewModel() {

	private var _profile = MutableStateFlow<Profile?>(null)
	val profile = _profile.asStateFlow()

	fun fetchUser(id: Int) {
		viewModelScope.launch {
			_profile.update { repositoryProfile.getProfileById(id) }
		}
	}

	fun onCheckIn(id: Int, type: Int){
		viewModelScope.launch {
			repositoryUser.postCheckIn(id, type)
		}
	}

	fun onCheckOut(id: Int){
		viewModelScope.launch {
			repositoryUser.postCheckOut(id)
		}
	}
}

data class Item(val title: String, val color: Color, val onCheckIn: () -> Unit, val onCheckOut: () -> Unit)