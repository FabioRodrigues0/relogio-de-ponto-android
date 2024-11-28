package com.cesaepulse.app.ui.views.home

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.lazy.grid.GridCells
import androidx.compose.foundation.lazy.grid.LazyVerticalGrid
import androidx.compose.material3.Button
import androidx.compose.material3.ButtonColors
import androidx.compose.material3.Card
import androidx.compose.material3.CircularProgressIndicator
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle

@Composable
fun HomePage(
    viewModel: HomePageViewModel = hiltViewModel(),
    isLogged: Boolean,
    id: Int
) {
    LaunchedEffect(key1 = true) {
        viewModel.fetchUser(id)
    }

    val list = listOf(
        Item(
            title = "Entrada Online",
            color = MaterialTheme.colorScheme.primary,
            onCheckIn = { viewModel.onCheckIn(id = id, 1) },
            onCheckOut = { viewModel.onCheckOut(id = id) }),
        Item(
            title = "Entrada Presencial",
            color = MaterialTheme.colorScheme.secondary,
            onCheckIn = { viewModel.onCheckIn(id = id, 2) },
            onCheckOut = { viewModel.onCheckOut(id = id) }),
        Item(
            title = "Entrada Externa",
            color = MaterialTheme.colorScheme.tertiary,
            onCheckIn = { viewModel.onCheckIn(id = id, 3) },
            onCheckOut = { viewModel.onCheckOut(id = id) }),
    )

    val uiState by viewModel.uiState.collectAsStateWithLifecycle()

    Card(
        modifier = Modifier
            .fillMaxSize()
            .padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
    ) {
        Column(
            verticalArrangement = Arrangement.spacedBy(-2.dp),
            modifier = Modifier.padding(20.dp)
        ) {
            if (uiState.isLoading) {
                CircularProgressIndicator(
                    modifier = Modifier.align(Alignment.CenterHorizontally)
                )
            }

            uiState.error?.let { errorMessage ->
                Text(
                    text = errorMessage,
                    color = MaterialTheme.colorScheme.error,
                    modifier = Modifier.padding(bottom = 8.dp)
                )
            }

            Text(
                text = "Olá,",
                fontWeight = FontWeight.Bold,
                fontSize = MaterialTheme.typography.displaySmall.fontSize
            )
            Text(
                text = uiState.profile?.name ?: "User",
                fontWeight = FontWeight.Bold,
                fontSize = MaterialTheme.typography.displaySmall.fontSize
            )

            LazyVerticalGrid(
                verticalArrangement = Arrangement.spacedBy(8.dp),
                horizontalArrangement = Arrangement.spacedBy(8.dp),
                columns = GridCells.Fixed(2),
                modifier = Modifier.padding(top = 16.dp)
            ) {
                items(list.size) { index ->
                    val item = list[index]
                    Box(
                        modifier = Modifier
                            .size(150.dp)
                            .background(
                                color = if (uiState.isCheckedIn) {
                                    Color.Gray
                                } else {
                                    item.color
                                },
                                shape = MaterialTheme.shapes.medium
                            )
                            .clickable {
                                if (uiState.isCheckedIn) {
                                    item.onCheckOut()
                                } else {
                                    item.onCheckIn()
                                }
                            }
                    ) {
                        Text(
                            text = item.title,
                            modifier = Modifier
                                .align(Alignment.Center)
                                .padding(8.dp),
                            textAlign = TextAlign.Center,
                            color = Color.White,
                            fontWeight = FontWeight.Bold
                        )
                    }
                }
            }
        }
    }
}