package com.cesaepulse.app.ui.views.UserPage

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.Card
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
import com.cesaepulse.app.ui.theme.Shapes
import com.cesaepulse.app.ui.theme.cesae1
import com.cesaepulse.app.ui.theme.cesae2
import com.cesaepulse.app.ui.theme.cesae3

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
			horizontalAlignment = Alignment.CenterHorizontally,
			modifier = Modifier.fillMaxSize()
		) {
			AsyncImage(
				model = user?.photo,
				contentDescription = null,
				modifier = Modifier
					.padding(vertical = 26.dp)
                    .size(156.dp)
                    .clip(Shapes.small),
				contentScale = ContentScale.Crop,
			)

			Text(
				text = "User",
				fontSize = TextUnit(30f, TextUnitType.Sp),
				fontWeight = FontWeight.Bold)
			Text(text = "2/11/2024 17:05")

			Text(text = "Horas", fontSize = TextUnit(25f, TextUnitType.Sp), fontWeight = FontWeight.Bold)
			Row(
				horizontalArrangement = Arrangement.spacedBy(20.dp),
				modifier = Modifier.padding(vertical = 20.dp)
			) {
				InfoHour(header = "Diárias", hour = "7h", color = cesae1)
				InfoHour(header = "Semanais", hour = "48h", color = cesae2)
				InfoHour(header = "Mensais", hour = "120h", color = cesae3)
			}
		}
	}
}