package com.cesaepulse.app

import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.SystemBarStyle
import androidx.activity.compose.setContent
import androidx.activity.enableEdgeToEdge
import androidx.compose.material3.Scaffold
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.Modifier
import androidx.compose.ui.tooling.preview.Preview
import androidx.navigation.compose.rememberNavController
import com.cesaepulse.app.ui.components.BottomNavBar.BottomNavBar
import com.cesaepulse.app.ui.components.SharedNavHost.SharedNavHost
import com.cesaepulse.app.ui.components.TopBar.TopBar
import com.cesaepulse.app.ui.theme.CesaepulseTheme
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        enableEdgeToEdge()
        setContent {
            CesaepulseTheme {
                val navController = rememberNavController()

                enableEdgeToEdge(
                    statusBarStyle = SystemBarStyle.dark(
                        android.graphics.Color.TRANSPARENT
                    )
                )
                Scaffold(
//                    modifier = Modifier.safeContentPadding(),
                    topBar = { TopBar() },
                    bottomBar = { BottomNavBar(navController) },
                ) { innerPadding ->
                    SharedNavHost(navController, innerPadding)
                }
            }

        }
    }
}

@Composable
fun Greeting(name: String, modifier: Modifier = Modifier) {
    Text(
        text = "Hello $name!",
        modifier = modifier
    )
}

@Preview(showBackground = true)
@Composable
fun GreetingPreview() {
    CesaepulseTheme {
        Greeting("LUIS")
    }
}

