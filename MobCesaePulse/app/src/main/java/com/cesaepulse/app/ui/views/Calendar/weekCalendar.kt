package com.cesaepulse.app.ui.views.Calendar



import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Button
import androidx.compose.material3.Card
import androidx.compose.material3.CardDefaults
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.unit.dp
import androidx.navigation.NavController


@Composable
fun WeekCalendar(navController: NavController) {

    Column(
        modifier = Modifier.padding(top = 120.dp)

    ) {


        DropDown()
        Button(onClick = {
            // Navega para "weekCalendar"
            navController.navigate("weekCalendar")

        }) {
            Text("semanal")
        }





        Card(
            modifier = Modifier

                .padding(10.dp),

            elevation = CardDefaults.cardElevation(100.dp)
        ) {
            Row(
                modifier = Modifier
                    .fillMaxWidth()
                    .padding(100.dp),
                verticalAlignment = Alignment.CenterVertically// Alinha o conteúdo verticalmente
            ) {
                // Círculo para o número
                Box(
                    modifier = Modifier
                        .size(40.dp)
                        .background(Color(0xFFE0E0FF), CircleShape), // Cor e forma circular
                    contentAlignment = Alignment.BottomEnd
                ) {
                    Text(
                        text = "1",
                        color = Color(0xFF000000),
                        style = MaterialTheme.typography.bodyMedium
                    )
                }

                Spacer(modifier = Modifier.width(8.dp)) // Espaço entre o círculo e o texto

                // Texto principal
                Text(
                    text = "de Agosto",
                    style = MaterialTheme.typography.bodyLarge,
                    modifier = Modifier.weight(1f) // Faz o texto ocupar o espaço restante
                )

                // Quadrado verde
                Box(
                    modifier = Modifier
                        .size(50.dp)
                        .background(
                            Color.Green,
                            shape = RoundedCornerShape(8.dp)
                        ) // Quadrado arredondado verde
                )
            }
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
