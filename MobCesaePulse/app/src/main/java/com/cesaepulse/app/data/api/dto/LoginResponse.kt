package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.User
import com.squareup.moshi.Json
import com.squareup.moshi.JsonClass

@JsonClass(generateAdapter = true)
data class LoginResponse(
	val message: String,
	val user: User,
	val session: Session
)

@JsonClass(generateAdapter = true)
data class Session(
	@Json(name = "token") val token: String,
	// Add other session fields if needed
)