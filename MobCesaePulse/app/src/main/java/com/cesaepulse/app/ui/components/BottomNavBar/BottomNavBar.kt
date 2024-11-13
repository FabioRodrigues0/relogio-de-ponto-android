package com.cesaepulse.app.ui.components.BottomNavBar

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Home
import androidx.compose.material.icons.filled.Search
import androidx.compose.material.icons.filled.VerifiedUser
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview

@Composable
fun BottomNavBar() {
    Row(
        horizontalArrangement = Arrangement.SpaceEvenly,
        modifier = Modifier
            .fillMaxWidth()
            .background(color = MaterialTheme.colorScheme.background)
    ) {
        IconButton(
            onClick = {}
        ) {
            Icon(Icons.Filled.Home, contentDescription = "Home")
        }
        IconButton(
            onClick = {}
        ) {
            Icon(Icons.Filled.Search, contentDescription = "Search")
        }
        IconButton(
            onClick = {}
        ) {
            Icon(Icons.Filled.VerifiedUser, contentDescription = "Administrator")
        }
    }
}

@Preview(showBackground = true, device = "id:pixel_3a", apiLevel = 33)
@Composable
fun GreetingPreview() {
    BottomNavBar()
}