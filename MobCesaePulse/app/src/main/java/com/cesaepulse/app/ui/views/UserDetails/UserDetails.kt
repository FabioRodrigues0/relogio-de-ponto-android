package com.cesaepulse.app.ui.views.UserDetails

import androidx.compose.foundation.Image
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Card
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.LaunchedEffect
import androidx.compose.runtime.getValue
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import coil.compose.AsyncImage
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.ui.views.UsersList.UsersListViewModel

@Composable
fun UsersDetails(
    viewModel: UsersDetailsViewModel = hiltViewModel(),
    id: Int
){
    LaunchedEffect(key1 = true) {
        viewModel.fetchUser(id)
    }

    val user by viewModel.user.collectAsStateWithLifecycle()

    Card(
        modifier = Modifier
            .fillMaxWidth()
            .padding(top = 110.dp)
    ) {
        Column (
            verticalArrangement = Arrangement.Center
        ) {
            AsyncImage(
                model = user?.photo,
                contentDescription = null,
                modifier = Modifier
                    .size(156.dp)
                    .clip(RoundedCornerShape(10.dp)),
                contentScale = ContentScale.Crop
            )

            Text(text = "User")
            Text(text = "2/11/2024 17:05")
        }
    }


}