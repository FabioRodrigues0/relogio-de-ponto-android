package com.cesaepulse.app.ui.views.user.page

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.Card
import androidx.compose.material3.HorizontalDivider
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.TextUnit
import androidx.compose.ui.unit.TextUnitType
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import coil.compose.AsyncImage
import com.cesaepulse.app.ui.components.InfoHours.InfoHour
import com.cesaepulse.app.ui.components.NavigationButton.NavigationButton
import com.cesaepulse.app.ui.theme.Shapes
import com.cesaepulse.app.ui.theme.primaryLight
import com.cesaepulse.app.ui.theme.secondaryLight
import com.cesaepulse.app.ui.theme.tertiaryLight

@Composable
fun UsersPage(
	viewModel: UsersPageViewModel = hiltViewModel(),
	id: Int
) {
	LaunchedEffect(key1 = true) {
		viewModel.fetchUser(id)
	}

	val user by viewModel.user.collectAsStateWithLifecycle()

	Card(
		modifier = Modifier
            .fillMaxSize()
            .padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
	) {
		Column(
			verticalArrangement = Arrangement.spacedBy(8.dp),
			modifier = Modifier
				.fillMaxSize()
				.padding(15.dp)
		) {
			Row(
				horizontalArrangement = Arrangement.SpaceEvenly,
				verticalAlignment = Alignment.CenterVertically
			){
				AsyncImage(
					model = user?.photo,
					contentDescription = null,
					modifier = Modifier
						.padding(vertical = 20.dp)
						.size(136.dp)
						.clip(Shapes.small),
					contentScale = ContentScale.Crop,
				)
				Column(
					modifier = Modifier.padding(start = 20.dp)
				) {
					Text(
						text = "User",
						fontSize = TextUnit(30f, TextUnitType.Sp),
						fontWeight = FontWeight.Bold)
					Text(text = "2/11/2024 17:05")
				}
			}
			Text(text = "Horas", fontSize = TextUnit(25f, TextUnitType.Sp), fontWeight = FontWeight.Bold)
			HorizontalDivider(thickness = 2.dp)
			Row(
				horizontalArrangement = Arrangement.spacedBy(20.dp),
				modifier = Modifier.padding(vertical = 10.dp)
			) {
				InfoHour(header = "Diárias", hour = "7h", color = primaryLight)
				InfoHour(header = "Semanais", hour = "48h", color = secondaryLight)
				InfoHour(header = "Mensais", hour = "120h", color = tertiaryLight)
			}
			NavigationButton(text = "Calendario", onClick = {})
			NavigationButton(text = "Calendario", onClick = {})
			NavigationButton(text = "Calendario", onClick = {})
			NavigationButton(text = "Calendario", onClick = {})
			NavigationButton(text = "Calendario", onClick = {})
		}
	}
}