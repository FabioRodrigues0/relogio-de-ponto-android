package com.cesaepulse.app.ui.views.admin.panel

import androidx.compose.foundation.layout.Row
import androidx.compose.material3.Button
import androidx.navigation.NavHostController
import com.cesaepulse.app.ui.AdminUserListRoute
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.Card
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp

@Composable
fun AdminPanel(
	navController: NavHostController,
) {

	Card(
		modifier = Modifier
			.fillMaxSize()
			.padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
	) {
		Column(
			verticalArrangement = Arrangement.spacedBy(-2.dp),
			modifier = Modifier.padding(20.dp)
		) {

			Text(
				text = "Admin Panel",
				fontWeight = FontWeight.Bold,
				fontSize = MaterialTheme.typography.displaySmall.fontSize
			)

			Row(
				horizontalArrangement = Arrangement.spacedBy(8.dp),
				modifier = Modifier.padding(top = 16.dp)
			) {
				Button(
					onClick = { navController.navigate(AdminUserListRoute) },
					modifier = Modifier
						.size(150.dp)
						.background(
							color = MaterialTheme.colorScheme.primary,
							shape = MaterialTheme.shapes.medium)
				){
					Text(text="Users List")
				}
			}
		}
	}
}