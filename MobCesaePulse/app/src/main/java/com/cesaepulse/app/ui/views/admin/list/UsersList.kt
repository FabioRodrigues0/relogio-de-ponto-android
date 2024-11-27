package com.cesaepulse.app.ui.views.admin.list

import androidx.compose.animation.AnimatedContent
import androidx.compose.animation.ExperimentalSharedTransitionApi
import androidx.compose.animation.SharedTransitionScope
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.PaddingValues
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.material3.CircularProgressIndicator
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.ui.views.admin.list.composable.UserCard

@OptIn(ExperimentalSharedTransitionApi::class)
@Composable
fun SharedTransitionScope.UsersList(
	onUserClick: (Int) -> Unit,
	viewModel: UsersListViewModel = hiltViewModel()
){

	val usersList by viewModel.usersList.collectAsStateWithLifecycle()

	Scaffold { innerPadding ->
		AnimatedContent(
			targetState = usersList.isEmpty(),
			label = "",
			modifier = Modifier.padding(innerPadding)
		) { isEmpty ->
			if (isEmpty) {
				Box(modifier = Modifier.fillMaxSize()
					.padding(innerPadding),
					contentAlignment = Alignment.Center
					) {
					CircularProgressIndicator()
				}
			} else {
				LazyColumn(
					verticalArrangement = Arrangement.spacedBy(8.dp),
					contentPadding = PaddingValues(
						start = 20.dp,
						end = 20.dp,
						top = 50.dp + innerPadding.calculateTopPadding(),
						bottom = 15.dp + innerPadding.calculateBottomPadding()),
				) {
					item {
						Text(
							text = "User: ",
							style = MaterialTheme.typography.displaySmall,
							fontWeight = FontWeight.Bold,
						)
					}
					items(usersList.size) { i ->
						UserCard(
							user = usersList[i],
							onClick = {
								onUserClick(usersList[i].id)
							},
						)
					}
				}

			}
		}
	}
}