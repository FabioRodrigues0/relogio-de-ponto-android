package com.cesaepulse.app.ui.views.login

import androidx.compose.foundation.border
import androidx.compose.foundation.clickable
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.requiredSize
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.foundation.text.BasicSecureTextField
import androidx.compose.foundation.text.input.TextFieldState
import androidx.compose.foundation.text.input.TextObfuscationMode
import androidx.compose.material.icons.Icons
import androidx.compose.material.icons.filled.Visibility
import androidx.compose.material.icons.filled.VisibilityOff
import androidx.compose.material3.Button
import androidx.compose.material3.ButtonColors
import androidx.compose.material3.Card
import androidx.compose.material3.Icon
import androidx.compose.material3.LocalTextStyle
import androidx.compose.material3.MaterialTheme
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Text
import androidx.compose.material3.TextButton
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.layout.ContentScale
import androidx.compose.ui.res.stringResource
import androidx.compose.ui.text.TextStyle
import androidx.compose.ui.text.input.VisualTransformation
import androidx.compose.ui.unit.dp
import androidx.hilt.navigation.compose.hiltViewModel
import androidx.lifecycle.compose.collectAsStateWithLifecycle
import androidx.navigation.NavController
import coil.compose.AsyncImage
import com.cesaepulse.app.R
import com.cesaepulse.app.ui.HomeRoute
import com.cesaepulse.app.ui.theme.Shapes

@Composable
fun LoginPage(
	navController: NavController,
	viewModel: LoginPageViewModel = hiltViewModel()
){
	val emailState by viewModel.email.collectAsStateWithLifecycle()
	val passwordState by viewModel.password.collectAsStateWithLifecycle()
	val isLogged by viewModel.isLogged.collectAsStateWithLifecycle()
	val user by viewModel.user.collectAsStateWithLifecycle()
	val showPassword by viewModel.showPassword.collectAsStateWithLifecycle()

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
				value = emailState,
				onValueChange = { viewModel.setEmail(it) },
				label = { "Email" },
				placeholder = { "Email" },
				singleLine = true,
				modifier = Modifier
					.fillMaxWidth(),
			)
			BasicSecureTextField(
				state = passwordState,
				textObfuscationMode = if (showPassword) TextObfuscationMode.Visible else TextObfuscationMode.RevealLastTyped,
				modifier = Modifier
					.fillMaxWidth()
					.border(1.dp, Color.DarkGray, RoundedCornerShape(6.dp))
					.padding(6.dp),
				decorator = { innerTextField ->
					Box(modifier = Modifier.fillMaxWidth()) {
						Box(
							modifier = Modifier
								.align(Alignment.CenterStart)
								.padding(start = 16.dp, end = 48.dp)
						) {
							innerTextField()
						}
						Icon(
							if (showPassword) {
								Icons.Filled.Visibility
							} else {
								Icons.Filled.VisibilityOff
							},
							contentDescription = "Toggle password visibility",
							modifier = Modifier
								.align(Alignment.CenterEnd)
								.requiredSize(48.dp).padding(16.dp)
								.clickable { viewModel.changePasswordVisibility() }
						)
					}
				}
			)

			Button(
				onClick = { viewModel.ckeckLogin() },
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
	if(isLogged && user != null){
		navController.navigate(HomeRoute(isLogged = true, id = user!!.id))
	}
}