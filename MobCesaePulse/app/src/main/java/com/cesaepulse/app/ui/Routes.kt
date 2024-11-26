package com.cesaepulse.app.ui

import kotlinx.serialization.Serializable

@Serializable
data object LoginRoute

@Serializable
data object UserListRoute

@Serializable
data class UserRoute(val id: Int)

@Serializable
data object HomeRoute

//@Serializable
//data object CalendarRoute
//
//@Serializable
//data object CalendarWeekRoute
//
//@Serializable
//data object detailsHoursRoute