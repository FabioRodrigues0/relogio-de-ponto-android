package com.cesaepulse.app.ui.components.NotificationButton.item

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.padding
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Delete
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.Icon
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import com.cesaepulse.app.domain.model.UserNotifacation

@Composable
fun NotificationItem(notification: UserNotifacation, onClick: () -> Unit){

	DropdownMenuItem(
		modifier = Modifier
			.padding(vertical = 2.dp),
		onClick = { onClick	},
		text = {
			Row(
				verticalAlignment = Alignment.CenterVertically,
				modifier = Modifier
					.padding(horizontal = 10.dp)
			) {
				Column (
					modifier = Modifier.weight(1f)
				){
					Text(text = notification.title,
						fontWeight = FontWeight.Bold,
						fontSize = MaterialTheme.typography.titleMedium.fontSize)
					Text(text = notification.description)
				}
			}
		},
		trailingIcon = {
			Icon(
				Icons.Filled.Delete,
				contentDescription = "Delete",
				tint = MaterialTheme.colorScheme.onPrimaryContainer,
				modifier = Modifier.padding(horizontal = 5.dp))})
}