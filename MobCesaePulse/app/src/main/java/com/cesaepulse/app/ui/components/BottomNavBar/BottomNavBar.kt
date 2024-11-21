package com.cesaepulse.app.ui.components.BottomNavBar

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Home
import androidx.compose.material.icons.filled.Person
import androidx.compose.material.icons.filled.VerifiedUser
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.platform.LocalContext
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import androidx.navigation.NavHostController
import com.cesaepulse.app.ui.HomeRoute
import com.cesaepulse.app.ui.UserListRoute
import com.cesaepulse.app.ui.UserRoute
import com.cesaepulse.app.ui.theme.primaryLight

@Composable
fun BottomNavBar(
    navController: NavHostController
) {
    Row(
        horizontalArrangement = Arrangement.SpaceAround,
        verticalAlignment = Alignment.CenterVertically,
        modifier = Modifier
            .padding(horizontal = 95.dp, vertical = 43.dp)
            .size(width = 220.dp, height = 50.dp)
            .background(color = MaterialTheme.colorScheme.primary, shape = MaterialTheme.shapes.medium)
    ) {
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = { navController.navigate(HomeRoute)}
        ) {
            Icon(
                Icons.Filled.Home,
                contentDescription = "Home",
                tint = MaterialTheme.colorScheme.onPrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = {navController.navigate(UserRoute(1))}
        ) {
            Icon(Icons.Filled.Person,
                contentDescription = "User",
                tint = MaterialTheme.colorScheme.onPrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }
        IconButton(
            modifier = Modifier.padding(horizontal = 10.dp),
            onClick = {navController.navigate(UserListRoute)}
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
    val navControllerTemp: NavHostController = NavHostController(LocalContext.current)
    BottomNavBar(navControllerTemp)
}