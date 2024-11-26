package com.cesaepulse.app.ui.views.calendar.dropdown

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.width
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.ExposedDropdownMenuBox
import androidx.compose.material3.ExposedDropdownMenuDefaults
import androidx.compose.material3.Text
import androidx.compose.material3.TextField
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import com.cesaepulse.app.ui.views.calendar.CalendarViewModel

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun CalendarSelect(
	viewModel: CalendarViewModel = hiltViewModel()
) {
	 val selectedText = viewModel.monthSelect.collectAsStateWithLifecycle()
	val isExpanded = viewModel.calendarExpanded.collectAsStateWithLifecycle()

	Column(
		modifier = Modifier
			.fillMaxWidth()
			.padding(5.dp),
		horizontalAlignment = Alignment.CenterHorizontally,
		verticalArrangement = Arrangement.Center
	) {
		ExposedDropdownMenuBox(
			expanded = isExpanded.value, // isExpanded,
			onExpandedChange = { viewModel.changeExpanded() }, //
			modifier = Modifier.width(180.dp),

			) {
			TextField(
				value = selectedText.value, //
				onValueChange = { }, // Não é necessário já que o TextField é readOnly
				label = { },
				readOnly = true,
				modifier = Modifier
					.menuAnchor()
					.fillMaxWidth(),
				trailingIcon = {
					ExposedDropdownMenuDefaults.TrailingIcon(expanded = false) // isExpanded
				}
			)

			// Reduz o tamanho do dropdown com Modifier.width() ou Modifier.size()
			ExposedDropdownMenu(
				expanded = isExpanded.value, // isExpanded
				onDismissRequest = { viewModel.changeExpanded() },
				modifier = Modifier.width(120.dp)

			) {
				viewModel.list.forEachIndexed { index, text ->
					DropdownMenuItem(
						text = { Text(text = text) },
						onClick = {
							viewModel.changeSelectedText(viewModel.list[index])
							viewModel.changeExpanded()
						},
						contentPadding = ExposedDropdownMenuDefaults.ItemContentPadding
					)
				}
			}
		}
	}
}