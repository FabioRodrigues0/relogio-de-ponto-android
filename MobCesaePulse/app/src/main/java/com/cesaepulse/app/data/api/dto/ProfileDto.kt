package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.Profile


/**
 *  Data Class of Profile
 *
 *  @param id: Int
 *  @param name: String
 *  @param email: String
 *  @param user_type_id: Int,
 *  @param foto: String?
 *  @param setor: String
 *  @param presences: List<PresenceRecordDto>
 */
data class ProfileDto(
	val id: Int,
	val name: String,
	val email: String,
	val user_type: String,
	val foto: String?,
	val setor: String,
	val presences: List<PresenceRecordDto>,
){
	/**
	 *  Convert ProfileDto to Profile
	 *
	 */
	fun toModel():  Profile =
		Profile(
			id= id,
			name = name,
			email = email,
			foto = foto,
			user_type = user_type,
			setor = setor,
			presences = presences.map { it.toModel() })
}

data class ProfileResponse(
	val data: ProfileDto
){
	fun toModel(): Profile = data.toModel()
}
