package com.cesaepulse.app.domain.model

/**
 *  Class of User
 *
 *  @param id: Int
 *  @param name: String
 *  @param email: String
 *  @param email_verified_at: String?
 *  @param photo: String?
 *  @param sector: String
 */
class User (
	val id: Int,
	val name: String,
	val email: String,
	// Talvez nao seja presiço
	val email_verified_at: String?,
	val photo: String?,
	val sector: String,
)