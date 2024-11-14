package com.cesaepulse.app.ui.components.BottomNavBar

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Home
import androidx.compose.material.icons.filled.Search
import androidx.compose.material.icons.filled.VerifiedUser
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import com.cesaepulse.app.ui.theme.primaryLight

@Composable
fun BottomNavBar() {
    Row(
        horizontalArrangement = Arrangement.SpaceAround,
        verticalAlignment = Alignment.CenterVertically,
        modifier = Modifier
            .padding(horizontal = 95.dp, vertical = 43.dp)
            .size(width = 220.dp, height = 50.dp)
            .background(color = primaryLight, shape = MaterialTheme.shapes.medium)
    ) {
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = {}
        ) {
            Icon(
                Icons.Filled.Home,
                contentDescription = "Home",
                tint = MaterialTheme.colorScheme.onPrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = {}
        ) {
            Icon(Icons.Filled.Search,
                contentDescription = "Search",
                tint = MaterialTheme.colorScheme.onPrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = {}
        ) {
            Icon(Icons.Filled.VerifiedUser,
                contentDescription = "Administrator",
                tint = MaterialTheme.colorScheme.onPrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }
    }
}

@Preview(showBackground = true, device = "id:pixel_3a")
@Composable
fun GreetingPreview() {
    BottomNavBar()
}