package com.cesaepulse.app.ui.views.UsersList.composable

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Card
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.unit.dp
import coil.compose.AsyncImage
import com.cesaepulse.app.domain.model.User

@Composable
fun UserCard(
	user: User,
	modifier: Modifier = Modifier,
	onClick: () -> Unit,
){
	Card(
		modifier = modifier,
		onClick = onClick
	) {
		Row(
			modifier = Modifier
				.padding(6.dp)
				.fillMaxWidth(),
			horizontalArrangement = Arrangement.spacedBy(10.dp),
			verticalAlignment = Alignment.CenterVertically
		) {
			AsyncImage(
				model = user.photo,
				contentDescription = null,
				modifier = Modifier
					.size(96.dp)
					.clip(RoundedCornerShape(10.dp)),
				contentScale = ContentScale.Crop
			)
			Column {
				Text(text = user.name)
				Text(text = user.email)
			}
		}
	}

}