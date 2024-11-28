package com.cesaepulse.app.data.api.dto

import com.squareup.moshi.JsonClass

@JsonClass(generateAdapter = true)
data class LogoutResponse(
	val message: String
)
