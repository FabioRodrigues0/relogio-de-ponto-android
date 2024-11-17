package com.cesaepulse.app.ui.views.login

import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.material3.Button
import androidx.compose.material3.ButtonColors
import androidx.compose.material3.Card
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.res.stringResource
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import coil.compose.AsyncImage
import com.cesaepulse.app.R
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun LoginPage(
	viewModel: LoginPageViewModel = hiltViewModel()
){
	val emailState = viewModel.email.collectAsStateWithLifecycle()
	val passwordState = viewModel.password.collectAsStateWithLifecycle()

	Card(
		modifier = Modifier
			.fillMaxSize()
			.padding(top = 105.dp, start = 10.dp, end = 10.dp, bottom = 10.dp)
	) {
		Column (
			verticalArrangement = Arrangement.Center,
			horizontalAlignment = Alignment.CenterHorizontally,
			modifier = Modifier
				.fillMaxSize()
				.padding(horizontal = 30.dp, vertical = 20.dp)
		){

			AsyncImage(
				model = stringResource(R.string.cesae_logo),
				contentDescription = "Logo CESAE",
				alignment = Alignment.TopStart,
				modifier = Modifier
					.size(270.dp, 150.dp)
					.clip(Shapes.small),
				contentScale = ContentScale.FillWidth,
			)
			OutlinedTextField(
				value = emailState.value,
				onValueChange = { viewModel.setEmail(it) },
				label = { "Email" },
				placeholder = { "Email" },
				singleLine = true,
				modifier = Modifier
					.fillMaxWidth(),
			)
			OutlinedTextField(
				value = passwordState.value,
				onValueChange = { viewModel.setPassword(it) },
				label = { Text("Password") },
				placeholder = { Text("Password") },
				supportingText = {
					TextButton(
						onClick = { },
					) { Text("Esqueceu-se da sua palavra chave?",
						fontSize = MaterialTheme.typography.bodySmall.fontSize)
					}
				},
				singleLine = true,
				modifier = Modifier
					.fillMaxWidth(),
			)

			Button(
				onClick = { },
				colors = ButtonColors(
					containerColor = MaterialTheme.colorScheme.tertiary,
					contentColor = MaterialTheme.colorScheme.onTertiary,
					disabledContainerColor = MaterialTheme.colorScheme.outline,
					disabledContentColor = MaterialTheme.colorScheme.outline
				),
				modifier = Modifier
					.fillMaxWidth()
			){
				Text("Login")
			}
		}

	}
}