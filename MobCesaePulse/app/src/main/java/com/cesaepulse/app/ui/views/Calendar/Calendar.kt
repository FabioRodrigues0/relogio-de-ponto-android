package com.cesaepulse.app.ui.views.calendar

import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.padding
import androidx.compose.material3.Card
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.PrimaryTabRow
import androidx.compose.material3.Tab
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.style.TextOverflow
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavController
import com.cesaepulse.app.ui.views.calendar.month.CalendarMonthScreen
import com.cesaepulse.app.ui.views.calendar.week.CalendarWeek

@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun Calendar(navController: NavController,
             viewModel: CalendarViewModel = hiltViewModel()
) {
    val state = viewModel.state.collectAsStateWithLifecycle()

    Card(
        modifier = Modifier
            .fillMaxSize()
            .padding(top = 125.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
    ) {
        Column{
            PrimaryTabRow(selectedTabIndex = state.value) {
                viewModel.titles.forEachIndexed { index, title ->
                    Tab(
                        selected = state.value == index,
                        onClick = { viewModel.updateState(index) },
                        text = {
                            Text(text = title,
                                style = MaterialTheme.typography.bodyLarge,
                                maxLines = 2,
                                overflow = TextOverflow.Ellipsis) }
                    )
                }
            }
            when (state.value) {
                0 -> CalendarMonthScreen()
                1 -> CalendarWeek(navController)
            }

        }
    }
}