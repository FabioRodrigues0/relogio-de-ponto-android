package com.cesaepulse.app.ui.components.NavigationButton

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.automirrored.filled.ArrowForward
import androidx.compose.material3.Icon
import androidx.compose.material3.IconButton
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.unit.dp
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun NavigationButton(text: String,
                     onClick: () -> Unit) {
    IconButton(
    onClick = onClick,
    modifier = Modifier
    .fillMaxWidth()
    .background(color = MaterialTheme.colorScheme.onPrimaryContainer, shape = Shapes.large)
    ) {
        Row(
            horizontalArrangement = Arrangement.SpaceBetween
        ){
            Text(text = text, Modifier
                .weight(1f)
                .padding(start = 15.dp),
                color = MaterialTheme.colorScheme.inversePrimary)
            Icon(
                Icons.AutoMirrored.Filled.ArrowForward,
                contentDescription = "Forward",
                tint = MaterialTheme.colorScheme.inversePrimary,
                modifier = Modifier.padding(horizontal = 10.dp))
        }

    }
}