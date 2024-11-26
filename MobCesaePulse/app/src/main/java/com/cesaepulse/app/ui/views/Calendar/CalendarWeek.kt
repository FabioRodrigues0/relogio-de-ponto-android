package com.cesaepulse.app.ui.views.calendar

import androidx.compose.foundation.background
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.lazy.LazyColumn
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Button
import androidx.compose.material3.Card
import androidx.compose.material3.CardDefaults
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.remember
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavController

@Composable
fun WeekCalendar(
    navController: NavController,
    viewModel: calendarViewModel = hiltViewModel()
) {
    //cards dos dias da semana
    viewModel.checkWorkDays()
    val cardTexts by viewModel.listWorkDays.collectAsStateWithLifecycle()
    val selectedText by viewModel.monthSelect.collectAsStateWithLifecycle()
    // Estado para controlar se a caixa de diálogo está aberta
    val openDialog = remember { mutableStateOf(false) }
    // Estado para o número do card selecionado
    val selectedCard = remember { mutableStateOf(0) }

    Column(
        modifier = Modifier.padding(top = 110.dp)
    ) {
        Box(
            modifier = Modifier
                .fillMaxWidth()
                .padding(16.dp), // Espaçamento ao redor, opcional
            contentAlignment = Alignment.Center // Centraliza o conteúdo dentro do Box
        ) {
            Button(
                onClick = {
                    navController.navigate("CalendarRoute")
                }, modifier = Modifier.width(200.dp) // Define uma largura fixa
            ) {
                Text("mensal")
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

        LazyColumn(
            modifier = Modifier
                .fillMaxWidth()
                .padding(16.dp), // Padding geral ao redor dos cartões
            verticalArrangement = Arrangement.spacedBy(8.dp) // Espaçamento entre os cartões
        ) {
            items(cardTexts.size) { i ->
                Card(
                    modifier = Modifier
                        .fillMaxWidth()
                        .padding(8.dp) // Padding individual do cartão
                        .clickable { // Adiciona a ação de clique
                            selectedCard.value = i + 1 // Definir o número do card selecionado
                            openDialog.value = true // Abre o Dialog
                        }, elevation = CardDefaults.cardElevation(5.dp) // Elevação ajustada
                ) {
                    Row(
                        modifier = Modifier
                            .fillMaxWidth()
                            .padding(20.dp), // Tamanho do card
                        verticalAlignment = Alignment.CenterVertically
                    ) {
                        // Círculo para o número
                        Box(
                            modifier = Modifier
                                .size(20.dp)
                                .background(Color(0xFFE0E0FF), CircleShape), // Cor e forma circular
                            contentAlignment = Alignment.Center
                        ) {
                            Text(
                                text = "${i + 1}",
                                color = Color(0xFF000000),
                                style = MaterialTheme.typography.bodyMedium
                            )
                        }

                        Spacer(modifier = Modifier.width(20.dp)) // Espaço entre o círculo e o texto

                        // Texto principal
                        Text(
                            text = "de $selectedText",//mes
                            style = MaterialTheme.typography.bodyLarge,
                            modifier = Modifier.weight(1f) // Faz o texto ocupar o espaço restante
                        )

                        // Quadrado verde
                        Box {
                            Column(modifier = Modifier.size(50.dp)) {
                                Text(
                                    text = "Manha",
                                    color = if(cardTexts[i].workType == WorkType.ONLINE) Color.Green else Color.Blue,
                                    modifier = Modifier
                                        .background(if(cardTexts[i].workType == WorkType.ONLINE) Color.Green else Color.Blue)
                                        .weight(1f) // Faz o texto ocupar o espaço restante
                                )
                                if(cardTexts[i].endHour != 17){
                                    Text(
                                        text = "Tarde",
                                        color = if(cardTexts[i].workType == WorkType.ONLINE) Color.Green else Color.Blue,
                                        modifier = Modifier
                                            .background(if(cardTexts[i].workType == WorkType.ONLINE) Color.Green else Color.Blue)
                                            .weight(1f) // Faz o texto ocupar o espaço restante
                                    )
                                }
                            }
                        }
                    }
                }
            }
        }


        // Caixa de diálogo que aparece quando openDialog é true

        if (openDialog.value) {
            AlertDialog(onDismissRequest = {
                openDialog.value = false
            }, // Fecha o Dialog ao tocar fora
                title = {
                    Text(text = "${selectedCard.value} de $selectedText") // Título do Dialog
                }, text = {
                    // Exibe o texto correspondente ao card selecionado
                    Text(text = "${cardTexts[selectedCard.value]}") // Texto diferente para cada card
                }, confirmButton = {
                    TextButton(onClick = { openDialog.value = false }) {
                        Text("Fechar")
                    }
                })
        }
    }
}

//    {
//    Card(
//        modifier = Modifier
//            .padding(150.dp),
//        elevation = CardDefaults.cardElevation(4.dp)
//    ) {
//        Column(
//            modifier = Modifier
//                .padding(16.dp),
//            verticalArrangement = Arrangement.Center
//        ) {
//            Text(
//                text = "Título do Card",
//                style = MaterialTheme.typography.headlineSmall
//            )
//            Text(
//                text = "Descrição breve sobre o conteúdo deste card. Você pode personalizar o texto conforme necessário.",
//                style = MaterialTheme.typography.bodyMedium
//            )
//            Button(
//                onClick = { /* Ação do botão */ },
//                //modifier = Modifier.align(LineHeightStyle.Alignment.Bottom)
//            ) {
//                Text("Ver Mais")
//            }
//        }
//    }
//}
//



// Função para exibir os dias de 1 a 31
//@Composable
//fun DaysOfMonth() {
//    // Lista com os dias do mês (1 a 31)
//    val daysOfMonth = (1..31).toList()
//
//    // Box para garantir que o conteúdo seja bem posicionado
//    Box(modifier = Modifier.fillMaxSize()) {
//        // LazyColumn para exibir os dias do mês verticalmente (com scroll)
//        LazyColumn(
//            modifier = Modifier
//                .fillMaxSize()
//                .padding(16.dp), // Padding geral
//            verticalArrangement = Arrangement.spacedBy(8.dp) // Espaçamento entre os dias
//        ) {
//            items(daysOfMonth) { day ->
//                DayCard(day = day, onClick = { println("Dia $day clicado") })
//            }
//        }
//    }
//}
//
//// Composable para exibir cada "card" de dia
//@Composable
//fun DayCard(day: Int, onClick: () -> Unit) {
//    // Exibindo o dia dentro de um Box com um clique
//    Box(
//        modifier = Modifier
//            .fillMaxWidth()
//            .clickable { onClick() }
//            .padding(12.dp)
//    ) {
//        Text(
//            text = "Dia $day",
//            style = MaterialTheme.typography.bodyMedium,
//            fontWeight = FontWeight.Bold,
//            modifier = Modifier.align(Alignment.Center)
//        )
//    }
//}
