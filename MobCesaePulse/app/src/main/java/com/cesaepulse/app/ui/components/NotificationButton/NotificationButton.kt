package com.cesaepulse.app.ui.components.NotificationButton

import androidx.compose.foundation.gestures.Orientation
import androidx.compose.foundation.gestures.scrollable
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.rememberScrollState
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.NotificationImportant
import androidx.compose.material3.DropdownMenu
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.domain.model.UserNotifacation
import com.cesaepulse.app.ui.components.NotificationButton.item.NotificationItem

@Composable
fun NotificationButton(
	viewModel: NotificationButtonViewModel = hiltViewModel(),
){
	val notificationsExpanded by viewModel.notificationsExpanded.collectAsStateWithLifecycle()
	val notificationsList by viewModel.notificationsList.collectAsStateWithLifecycle()

	for (i in 1..3) {
		viewModel.addNotification(UserNotifacation(i,"Notification $i", "Description $i"))
	}

	IconButton(
		modifier = Modifier.padding(horizontal = 10.dp),
		onClick = {viewModel.toggleNotifications()}
	) {
		Icon(
			Icons.Filled.NotificationImportant,
			contentDescription = "Open Settings",
			tint = MaterialTheme.colorScheme.inversePrimary,
			modifier = Modifier.padding(horizontal = 10.dp)
		)
	}
	DropdownMenu(
		expanded = notificationsExpanded,
		onDismissRequest = { viewModel.toggleNotifications() },
		modifier = Modifier
			.size(width = 260.dp, height = 230.dp)
			.scrollable(orientation = Orientation.Vertical, state = rememberScrollState())
			.padding(horizontal = 10.dp)
	) {
		notificationsList.forEachIndexed { index, notification ->
			NotificationItem(
				notification = notification,
				onClick = { viewModel.removeNotification(notification) })
		}
	}
}