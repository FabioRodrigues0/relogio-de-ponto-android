package com.cesaepulse.app.ui.components.NotificationButton

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.data.mockRepositories.MockUserRepo
import com.cesaepulse.app.domain.model.UserNotifacation
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import javax.inject.Inject

@HiltViewModel
class NotificationButtonViewModel @Inject constructor(
	private val repository:MockUserRepo
)  : ViewModel() {

	private val _notificationsExpanded = MutableStateFlow<Boolean>(false)
	val notificationsExpanded = _notificationsExpanded.asStateFlow()
	private val _notificationsList = MutableStateFlow<ArrayList<UserNotifacation>>(arrayListOf<UserNotifacation>())
	val notificationsList = _notificationsList.asStateFlow()

	fun addNotification(notification: UserNotifacation) {
		viewModelScope.launch {
			val list = ArrayList(_notificationsList.value)
			list.add(notification)

			_notificationsList.update {
				list
			}
		}
	}

	fun removeNotification(notification: UserNotifacation) {
		viewModelScope.launch {
			val list = ArrayList(_notificationsList.value)
			list.remove(notification)

			_notificationsList.update {
				list
			}
		}
	}

	fun toggleNotifications() {
		_notificationsExpanded.value = !_notificationsExpanded.value
	}

}