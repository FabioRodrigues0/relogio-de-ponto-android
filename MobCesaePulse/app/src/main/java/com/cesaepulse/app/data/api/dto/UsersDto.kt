package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.User

/**
 *  Data Class of User
 *
 *  @param id: Int
 *  @param name: String
 *  @param email: String
 *  @param users_type_id: Int,
 *  @param foto: String?
 *  @param setor: String
 */
data class UsersDto(
	val id: Int,
	val name: String,
	val email: String,
	val users_type_id: Int,
	val foto: String?,
	val setor: String,
){
	/**
	 *  Convert UserDto to User
	 *
	 */
	fun toModel():  User =
		User(id= id, name = name, email = email, foto = foto, users_type_id = users_type_id, setor = setor)
}

data class UserResponse(
	val data: UsersDto
){
	fun toModel(): User = data.toModel()
}

data class ListUserResponse(
	val data: List<UsersDto>
){
	fun toModel(): List<User> = data.map { it.toModel() }
}
