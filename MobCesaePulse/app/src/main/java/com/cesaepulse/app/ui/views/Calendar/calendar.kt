package com.cesaepulse.app.ui.views.Calendar

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.lazy.grid.GridCells
import androidx.compose.foundation.lazy.grid.LazyVerticalGrid
import androidx.compose.material3.Button
import androidx.compose.material3.DropdownMenuItem
import androidx.compose.material3.ExperimentalMaterial3Api
import androidx.compose.material3.ExposedDropdownMenuBox
import androidx.compose.material3.ExposedDropdownMenuDefaults
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TextField
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavController
import java.time.YearMonth


// menu com os meses para selecionar
@OptIn(ExperimentalMaterial3Api::class)
@Composable
fun DropDown(
    viewModel: calendarViewModel = hiltViewModel(),
) {

    val selectedText by viewModel.monthSelect.collectAsStateWithLifecycle()
    val isExpanded by viewModel.calendarExpanded.collectAsStateWithLifecycle()

    Column(
        modifier = Modifier
            .padding(5.dp),
        horizontalAlignment = Alignment.CenterHorizontally,
        verticalArrangement = Arrangement.Center
    ) {
        ExposedDropdownMenuBox(
            expanded = isExpanded,
            onExpandedChange = { viewModel.changeExpanded() },
            modifier = Modifier.width(180.dp),

        ) {
            TextField(
                value = selectedText,
                onValueChange = { }, // Não é necessário já que o TextField é readOnly
                label = { Text("Selecionar mês") },
                readOnly = true,
                modifier = Modifier.menuAnchor(),
                trailingIcon = {
                    ExposedDropdownMenuDefaults.TrailingIcon(expanded = isExpanded)
                }
            )

            // Reduz o tamanho do dropdown com Modifier.width() ou Modifier.size()
            ExposedDropdownMenu(
                expanded = isExpanded,
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











//botoes de semanal e reset

@Composable
fun Calendar(navController: NavController) {
    val currentMonth = YearMonth.now()
    val daysInMonth = currentMonth.lengthOfMonth()
    val firstDayOfMonth = currentMonth.atDay(1)
    val dayOfWeek = firstDayOfMonth.dayOfWeek.value % 7



    Column(
        modifier = Modifier.fillMaxSize().padding(top = 120.dp),
        verticalArrangement = Arrangement.Top
    ) {

        Row(
            horizontalArrangement = Arrangement.Center,
            modifier = Modifier.fillMaxWidth()
        ) {

            Button(onClick = {
                // Navega para "weekCalendar"
                navController.navigate(" weekCalendar")
            }) {
                Text("semanal")
            }

            Spacer(modifier = Modifier.width(20.dp))

            Button(onClick = {
                // Navega para "weekCalendar"
                navController.navigate("")
            }) {
                Text("reset")
            }
        }

        //botoes de passar os meses+menu

        Row {

            DropDown()
            Button(onClick = {
                navController.navigate("")


            }) {
                Text("<")

            }

            Button(onClick = {
                navController.navigate("")


            }) {
                Text(">")

            }

        }


        //calendario mensal

        Column(
            modifier = Modifier
                .fillMaxSize()
                .padding(16.dp), // Padding opcional para garantir que o conteúdo não fique colado nas bordas
            horizontalAlignment = Alignment.CenterHorizontally,
            //verticalArrangement = Arrangement.
        ) {
            // Título do calendário
            Text(
                text = "NOVEMBRO",
                style = MaterialTheme.typography.headlineSmall
            )

            Spacer(modifier = Modifier.height(30.dp)) // Espaço entre o título e o conteúdo

            // Cabeçalho com os dias da semana
            Row(
                modifier = Modifier.fillMaxWidth(),
                horizontalArrangement = Arrangement.SpaceAround // Distribui os dias igualmente
            ) {
                listOf("Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab").forEach { day ->
                    Text(
                        text = day,
                        style = MaterialTheme.typography.bodyMedium,
                        textAlign = TextAlign.Center
                    )
                }
            }

            Spacer(modifier = Modifier.height(5.dp)) // Espaço entre o cabeçalho e a grade de dias

            // Grid de dias do mês
            LazyVerticalGrid(
                columns = GridCells.Fixed(7), // 7 colunas para os 7 dias da semana
                content = {
                    // Espaços vazios até o primeiro dia do mês
                    items(dayOfWeek) {
                        Text(
                            text = "", // Espaços vazios
                            modifier = Modifier.height(40.dp)
                        )
                    }

                    // Dias do mês
                    items(daysInMonth) { day ->
                        Box(
                            modifier = Modifier
                                .height(40.dp)
                                .fillMaxWidth()
                                .padding(4.dp), // Espaçamento entre as células
                            contentAlignment = Alignment.Center
                        ) {
                            Text(text = (day + 1).toString())
                        }
                    }
                }
            )
        }
    }

}







