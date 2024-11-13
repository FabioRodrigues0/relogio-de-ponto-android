package com.cesaepulse.app.ui

import kotlinx.serialization.Serializable


@Serializable
data object UserListRoute

@Serializable
data class UserRoute(val id: Int)