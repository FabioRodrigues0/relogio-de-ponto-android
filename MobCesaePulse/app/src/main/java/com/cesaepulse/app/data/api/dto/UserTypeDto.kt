package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.UserType

/**
 *  Data Class of UserType
 *
 *  @param id: Int
 *  @param type: String
 *  */
data class UserTypeDto(
	val id: Int,
	val type: String
){
	/**
	 *  Convert UserTypeDto to UserType
	 *
	 */
	fun toModel():  UserType = UserType(id= id, type = type)
}
