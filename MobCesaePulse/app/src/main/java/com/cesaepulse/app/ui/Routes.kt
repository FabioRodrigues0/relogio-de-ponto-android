package com.cesaepulse.app.ui

import kotlinx.serialization.Serializable

@Serializable
data object LoginRoute

@Serializable
data object UserListRoute

@Serializable
data class UserRoute(val id: Int)

//@Serializable
//data object UserHoursRoute

@Serializable
data class HomeRoute(val isLogged: Boolean, val id: Int)

@Serializable
data object CalendarRoute

@Serializable
data object DetailsHoursRoute

@Serializable
data object ProfileActivityRoute

//@Serializable
//data object CalendarWeekRoute
