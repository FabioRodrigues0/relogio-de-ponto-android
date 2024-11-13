package com.cesaepulse.app.ui.components.SharedNavHost

import androidx.compose.animation.ExperimentalSharedTransitionApi
import androidx.compose.animation.SharedTransitionLayout
import androidx.compose.foundation.layout.PaddingValues
import androidx.compose.runtime.Composable
import androidx.navigation.NavHostController
import androidx.navigation.compose.NavHost
import androidx.navigation.compose.composable
import androidx.navigation.toRoute
import com.cesaepulse.app.ui.UserListRoute
import com.cesaepulse.app.ui.UserRoute
import com.cesaepulse.app.ui.views.UserDetails.UsersDetails
import com.cesaepulse.app.ui.views.UsersList.UsersList

@Composable
@OptIn(ExperimentalSharedTransitionApi::class)
fun SharedNavHost(navController: NavHostController, innerPadding: PaddingValues){
    SharedTransitionLayout {
        NavHost(navController = navController, startDestination = UserListRoute) {
            composable<UserListRoute> {
                UsersList(
                    onUserClick = { id ->
                        navController.navigate(
                            UserRoute(id = id)
                        )
                    })
            }

            composable<UserRoute> {
                val args = it.toRoute<UserRoute>()

                UsersDetails(id = args.id.toInt())
            }
        }
    }
}