package com.cesaepulse.app.ui.views.home

import androidx.compose.ui.graphics.Color
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.data.mockRepositories.MockUserRepo
import com.cesaepulse.app.domain.model.Profile
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

data class HomePageUiState(
    val profile: Profile? = null,
    val isLoading: Boolean = false,
    val error: String? = null,
    val isCheckedIn: Boolean = false
)

@HiltViewModel
class HomePageViewModel @Inject constructor(
    private val repositoryProfile: MockUserRepo,
) : ViewModel() {

    private val _uiState = MutableStateFlow(HomePageUiState())
    val uiState = _uiState.asStateFlow()

    fun fetchUser(id: Int) {
        viewModelScope.launch {
            _uiState.update { it.copy(isLoading = true, error = null) }
            try {
                val profile = repositoryProfile.getProfileById(id)
                _uiState.update { 
                    it.copy(
                        profile = profile,
                        isLoading = false
                    )
                }
            } catch (e: Exception) {
                _uiState.update { 
                    it.copy(
                        error = e.message ?: "Failed to fetch user profile",
                        isLoading = false
                    )
                }
            }
        }
    }

    fun onCheckIn(id: Int, type: Int) {
        viewModelScope.launch {
            _uiState.update { it.copy(isLoading = true, error = null) }
            try {
                // Simulate check-in
                _uiState.update { 
                    it.copy(
                        isCheckedIn = true,
                        isLoading = false
                    )
                }
            } catch (e: Exception) {
                _uiState.update { 
                    it.copy(
                        error = e.message ?: "Failed to check in",
                        isLoading = false
                    )
                }
            }
        }
    }

    fun onCheckOut(id: Int) {
        viewModelScope.launch {
            _uiState.update { it.copy(isLoading = true, error = null) }
            try {
                // Simulate check-out
                _uiState.update { 
                    it.copy(
                        isCheckedIn = false,
                        isLoading = false
                    )
                }
            } catch (e: Exception) {
                _uiState.update { 
                    it.copy(
                        error = e.message ?: "Failed to check out",
                        isLoading = false
                    )
                }
            }
        }
    }
}

data class Item(val title: String, val color: Color, val onCheckIn: () -> Unit, val onCheckOut: () -> Unit)