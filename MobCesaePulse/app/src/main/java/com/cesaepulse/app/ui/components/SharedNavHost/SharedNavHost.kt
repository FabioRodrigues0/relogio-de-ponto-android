package com.cesaepulse.app.ui.components.SharedNavHost

import androidx.compose.animation.ExperimentalSharedTransitionApi
import androidx.compose.animation.SharedTransitionLayout
import androidx.compose.foundation.layout.PaddingValues
import androidx.compose.runtime.Composable
import androidx.navigation.NavHostController
import androidx.navigation.compose.NavHost
import androidx.navigation.compose.composable
import androidx.navigation.toRoute
import com.cesaepulse.app.ui.CalendarRoute
import com.cesaepulse.app.ui.HomeRoute
import com.cesaepulse.app.ui.LoginRoute
import com.cesaepulse.app.ui.UserListRoute
import com.cesaepulse.app.ui.UserRoute
import com.cesaepulse.app.ui.WeekCalendarRoute
import com.cesaepulse.app.ui.detailsHoursRoute
import com.cesaepulse.app.ui.views.Calendar.Calendar
import com.cesaepulse.app.ui.views.Calendar.WeekCalendar
import com.cesaepulse.app.ui.views.home.HomePage
import com.cesaepulse.app.ui.views.login.LoginPage
import com.cesaepulse.app.ui.views.totalHours.TimeEntry
import com.cesaepulse.app.ui.views.totalHours.TimeTable

import com.cesaepulse.app.ui.views.user.list.UsersList
import com.cesaepulse.app.ui.views.user.page.UsersPage

@Composable
@OptIn(ExperimentalSharedTransitionApi::class)
fun SharedNavHost(navController: NavHostController, innerPadding: PaddingValues) {
    SharedTransitionLayout {
        NavHost(navController = navController, startDestination = detailsHoursRoute) {

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

                UsersPage(id = args.id.toInt(), navController = navController)
            }

            composable<HomeRoute> {
                HomePage()
            }

            composable<LoginRoute> {
                LoginPage()
            }
            composable<CalendarRoute> {
                Calendar(navController)

            }
            composable<WeekCalendarRoute> {
                WeekCalendar(navController)
            }
            composable<detailsHoursRoute> {
               // TableScreen()
                TimeTable(
                    timeEntries = listOf(
                        TimeEntry("2024-11-25", 9.53),
                        TimeEntry("2024-11-24", 6.03),
                        TimeEntry("2024-11-23", 5.8),
                        TimeEntry("2024-11-22", 9.53),
                        TimeEntry("2024-11-21", 6.03),
                        TimeEntry("2024-11-20", 5.8),
                        TimeEntry("2024-11-19", 5.53),
                        TimeEntry("2024-11-18", 6.03),
                        TimeEntry("2024-11-17", 4.8),
                        TimeEntry("2024-11-16", 6.50),
                        TimeEntry("2024-11-15", 5.8),
                        TimeEntry("2024-11-14", 9.53),
                        TimeEntry("2024-11-13", 6.03),
                        TimeEntry("2024-11-12", 8.0),
                        TimeEntry("2024-11-11", 8.50),
                        TimeEntry("2024-11-10", 6.20),
                        TimeEntry("2024-11-09", 7.0),
                    )
                )
            }

        }
    }
}
