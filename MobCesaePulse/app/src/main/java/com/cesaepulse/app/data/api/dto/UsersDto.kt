package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.User

/**
 *  Data Class of User
 *
 *  @param id: Int
 *  @param name: String
 *  @param email: String
 *  @param email_verified_at: String?
 *  @param photo: String?
 *  @param sector: String
 */
data class UsersDto(
	val id: Int,
	val name: String,
	val email: String,
	val email_verified_at: String?,
	val photo: String?,
	val sector: String,
	val created_at: String,
	val updated_at: String
){
	/**
	 *  Convert UserDto to User
	 *
	 */
	fun toModel():  User =
		User(id= id, name = name, email = email, email_verified_at = email_verified_at, photo = photo, sector = sector)
}