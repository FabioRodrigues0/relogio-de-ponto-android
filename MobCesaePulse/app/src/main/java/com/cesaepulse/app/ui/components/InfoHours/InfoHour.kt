package com.cesaepulse.app.ui.components.InfoHours

import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.TextUnit
import androidx.compose.ui.unit.TextUnitType
import androidx.compose.ui.unit.dp
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun InfoHour(
	header: String,
	hour: String,
	color: Color,
	colorText: Color
){
	Column(
		horizontalAlignment = Alignment.CenterHorizontally,
		verticalArrangement = Arrangement.spacedBy(15.dp),
		modifier = Modifier
			.background(color = color, shape = Shapes.medium)
			.size(100.dp)
	) {
		Text(
			text = header,
			modifier = Modifier.padding(top = 10.dp),
			color = colorText)
		Text(
			text = hour,
			fontSize = TextUnit(25f, TextUnitType.Sp),
			fontWeight = FontWeight.Bold,
			color = colorText)

	}
}