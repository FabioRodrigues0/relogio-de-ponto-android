package com.cesaepulse.app.ui.components.TopBar

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.MoreVert
import androidx.compose.material3.DropdownMenu
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.material3.TopAppBarDefaults.topAppBarColors
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.ui.components.NotificationButton.NotificationButton
import com.cesaepulse.app.ui.theme.primaryLight

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun TopBar(
	viewModel: TopBarViewModel = hiltViewModel(),
) {
	val menuExpanded by viewModel.menuExpanded.collectAsStateWithLifecycle()

	TopAppBar(
		colors = topAppBarColors(
			containerColor = primaryLight,
			titleContentColor = MaterialTheme.colorScheme.onTertiary,
		),
		actions = {
			Row(
				horizontalArrangement = Arrangement.Center,
				verticalAlignment = Alignment.CenterVertically,
			) {
				NotificationButton()
				IconButton(onClick = { viewModel.toggleMenu() }) {
					Icon(
						imageVector = Icons.Filled.MoreVert,
						contentDescription = "More",
					)
				}
			}
			DropdownMenu(
				expanded = menuExpanded,
				onDismissRequest = { viewModel.toggleMenu() },
			) {
				DropdownMenuItem(
					text = {
						Text("Logout")
					},
					onClick = { /* TODO */ },
				)
			}
		},
		title = {
			Text("Top app bar")
		}
	)
}