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
 *  @param presences: List<PresenceRecord>
 */
data class Profile (
	val id: Int,
	val name: String,
	val email: String,
	val user_type: String,
	val foto: String?,
	val setor: String,
	val presences: List<PresenceRecord>
)
