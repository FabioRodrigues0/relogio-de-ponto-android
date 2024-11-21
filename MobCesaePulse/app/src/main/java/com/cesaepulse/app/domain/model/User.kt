package com.cesaepulse.app.domain.model

/**
 *  Class of User
 *
 *  @param id: Int
 *  @param name: String
 *  @param email: String
 *  @param user_type_id: Int,
 *  @param foto: String?
 *  @param setor: String
 */
data class User (
	val id: Int,
	val name: String,
	val email: String,
	val users_type_id: Int,
	val foto: String?,
	val setor: String,
)