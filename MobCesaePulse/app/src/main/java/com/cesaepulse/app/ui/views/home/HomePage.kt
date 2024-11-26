package com.cesaepulse.app.ui.views.home

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.lazy.grid.GridCells
import androidx.compose.foundation.lazy.grid.LazyVerticalGrid
import androidx.compose.material3.Card
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle

@Composable
fun HomePage(
	viewModel: HomePageViewModel = hiltViewModel(),
){

	LaunchedEffect(key1 = true) {

	}

	val user by viewModel.user.collectAsStateWithLifecycle()


	Card(
		modifier = Modifier
			.fillMaxSize()
			.padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
	) {
		Column(
			verticalArrangement = Arrangement.spacedBy(-2.dp),
			modifier = Modifier.padding(20.dp)
		){
			Text(text = "Olá,",
				fontWeight = FontWeight.Bold,
				fontSize = MaterialTheme.typography.displaySmall.fontSize)
			Text(text = "User 1",
				fontWeight = FontWeight.Bold,
				fontSize = MaterialTheme.typography.displaySmall.fontSize)

			LazyVerticalGrid(
				verticalArrangement = Arrangement.spacedBy(8.dp),
				horizontalArrangement = Arrangement.spacedBy(8.dp),
				columns = GridCells.Fixed(2),
				modifier = Modifier
					.padding(top = 16.dp)
			) {
				items(4) {
					Box(
						contentAlignment = Alignment.Center,
						modifier = Modifier
							.background(MaterialTheme.colorScheme.errorContainer, shape = MaterialTheme.shapes.medium)
							.size(width = 100.dp, height = 285.dp)
					){
						Text(text = "teste")
					}
				}
			}
		}
	}
}