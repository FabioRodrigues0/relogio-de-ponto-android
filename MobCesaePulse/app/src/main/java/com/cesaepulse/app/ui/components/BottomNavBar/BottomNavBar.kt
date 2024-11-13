package com.cesaepulse.app.ui.components.BottomNavBar

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.padding
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
import androidx.compose.ui.unit.dp

@Composable
fun BottomNavBar() {
    Row(
        horizontalArrangement = Arrangement.SpaceEvenly,
        modifier = Modifier
            .padding(horizontal = 130.dp, vertical = 40.dp)
            .background(color = MaterialTheme.colorScheme.background, shape = MaterialTheme.shapes.medium)
    ) {
        IconButton(
            onClick = {}
        ) {
            Icon(
                Icons.Filled.Home,
                contentDescription = "Home",
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            onClick = {}
        ) {
            Icon(Icons.Filled.Search,
                contentDescription = "Search",
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            onClick = {}
        ) {
            Icon(Icons.Filled.VerifiedUser,
                contentDescription = "Administrator",
                modifier = Modifier.padding(horizontal = 10.dp))
        }
    }
}

@Preview(showBackground = true, device = "id:pixel_3a")
@Composable
fun GreetingPreview() {
    BottomNavBar()
}