package com.cesaepulse.app.ui.components.InfoUser

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.TextUnit
import androidx.compose.ui.unit.TextUnitType
import androidx.compose.ui.unit.dp
import coil.compose.AsyncImage
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun InfoUser(user: User){
    Row(
        horizontalArrangement = Arrangement.SpaceEvenly,
        verticalAlignment = Alignment.CenterVertically
    ){
        AsyncImage(
            model = user.photo,
            contentDescription = null,
            modifier = Modifier
                .padding(vertical = 20.dp)
                .size(136.dp)
                .clip(Shapes.small),
            contentScale = ContentScale.Crop,
        )
        Column(
            modifier = Modifier.padding(start = 20.dp)
        ) {
            Text(
                text = user.name,
                fontSize = TextUnit(30f, TextUnitType.Sp),
                fontWeight = FontWeight.Bold)
            Text(text = "2/11/2024 17:05")
        }
    }
}