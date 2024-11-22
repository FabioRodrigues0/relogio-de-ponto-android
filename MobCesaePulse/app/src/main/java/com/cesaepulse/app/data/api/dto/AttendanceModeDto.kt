package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.AttendanceMode

/**
 *  Data Class of User
 *
 *  @param id: Int
 *  @param description: String
 */
data class AttendanceModeDto(
	val id: Int,
	val description: String,
){
	/**
	 *  Convert AttendenceModeDto to AttendenceMode
	 *
	 */
	fun toModel():  AttendanceMode =
		AttendanceMode(
			id= id,
			description = description
		)
}
