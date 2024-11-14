package com.cesaepulse.app.ui.components.TopBar

import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TopAppBar
import androidx.compose.material3.TopAppBarDefaults.topAppBarColors
import androidx.compose.runtime.Composable
import com.cesaepulse.app.ui.theme.primaryLight

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun TopBar(){
    TopAppBar(
        colors = topAppBarColors(
            containerColor = primaryLight,
            titleContentColor = MaterialTheme.colorScheme.onTertiary,
        ),
        title = {
            Text("Top app bar")
        }
    )
}