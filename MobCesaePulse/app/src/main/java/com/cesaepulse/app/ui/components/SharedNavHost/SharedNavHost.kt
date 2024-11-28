package com.cesaepulse.app.ui.components.SharedNavHost

import androidx.compose.animation.ExperimentalSharedTransitionApi
import androidx.compose.animation.SharedTransitionLayout
import androidx.compose.foundation.layout.PaddingValues
import androidx.compose.runtime.Composable
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.navigation.NavHostController
import androidx.navigation.compose.NavHost
import androidx.navigation.compose.composable
import androidx.navigation.toRoute
import com.cesaepulse.app.ui.AdminPanelRoute
import com.cesaepulse.app.ui.AdminUserListRoute
import com.cesaepulse.app.ui.AdminUserRoute
import com.cesaepulse.app.ui.CalendarRoute
import com.cesaepulse.app.ui.DetailsHoursRoute
import com.cesaepulse.app.ui.HomeRoute
import com.cesaepulse.app.ui.LoginRoute
import com.cesaepulse.app.ui.ProfileActivityRoute
import com.cesaepulse.app.ui.UserRoute
import com.cesaepulse.app.ui.views.admin.list.UsersList
import com.cesaepulse.app.ui.views.admin.page.AdminUsersPage
import com.cesaepulse.app.ui.views.admin.panel.AdminPanel
import com.cesaepulse.app.ui.views.calendar.Calendar
import com.cesaepulse.app.ui.views.home.HomePage
import com.cesaepulse.app.ui.views.login.LoginPage
import com.cesaepulse.app.ui.views.profile.activity.ProfileActivity
import com.cesaepulse.app.ui.views.profile.detailsHours.DetailsHours
import com.cesaepulse.app.ui.views.profile.page.UsersPage

@Composable
@OptIn(ExperimentalSharedTransitionApi::class)
fun SharedNavHost(navController: NavHostController, innerPadding: PaddingValues){
    val _id = remember { mutableStateOf(0) }

    fun setID(id: Int){
        _id.value = id
    }

    SharedTransitionLayout {
        NavHost(navController = navController, startDestination = LoginRoute) {

            composable<AdminUserListRoute> {
                UsersList(
                    onUserClick = { id ->
                        navController.navigate(
                            AdminUserRoute
                        )
                    })
            }

            composable<AdminPanelRoute> {
                AdminPanel(navController = navController)
            }

            composable<AdminUserRoute> {
                val args = it.toRoute<AdminUserRoute>()

                AdminUsersPage(id = _id.value , navController = navController)
            }

            composable<UserRoute> {
                val args = it.toRoute<UserRoute>()

                UsersPage(id = _id.value, navController = navController)
            }

            composable<HomeRoute> {
                val args = it.toRoute<HomeRoute>()
                setID(args.id.toInt())
                HomePage(id = _id.value, isLogged = args.isLogged)
            }

            composable<LoginRoute> {
                LoginPage(navController)
            }

            composable<CalendarRoute> {
                Calendar(navController)
            }
            composable<DetailsHoursRoute> {
                DetailsHours()
            }
            composable<ProfileActivityRoute> {
                ProfileActivity()
            }
        }
    }
}