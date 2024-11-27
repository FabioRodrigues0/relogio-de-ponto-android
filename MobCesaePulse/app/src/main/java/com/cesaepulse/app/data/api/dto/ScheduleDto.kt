package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.Schedule
import com.squareup.moshi.Json
import com.squareup.moshi.JsonClass

/**
 *  Class of ScheduleDto
 *
 *  @param id: Int
 *  @param morning_entry_time: String
 *  @param morning_exit_time: String
 *  @param afternoon_entry_time: String
 *  @param afternoon_exit_time: String
 *  @param attendance_mode_id: Int
 *  @param user_id: Int
 *  @param created_at: Timestamp
 *  @param updated_at: Timestamp
 *
 */
@JsonClass(generateAdapter = true)
data class ScheduleDto(
	@Json(name = "id") val id: Int,
	@Json(name = "morning_entry_time") val morning_entry_time: String,
	@Json(name = "morning_exit_time") val morning_exit_time: String,
	@Json(name = "afternoon_entry_time") val afternoon_entry_time: String,
	@Json(name = "afternoon_exit_time") val afternoon_exit_time: String,
	@Json(name = "user_id") val user_id: Int,
	@Json(name = "attendance_mode_id") val attendance_mode_id: Int,
	@Json(name = "created_at") val created_at: String
) {
	fun toModel(): Schedule =
		Schedule(
			id = id,
			morning_entry_time = morning_entry_time,
			morning_exit_time = morning_exit_time,
			afternoon_entry_time = afternoon_entry_time,
			afternoon_exit_time = afternoon_exit_time,
			user_id = user_id,
			attendance_mode_id = attendance_mode_id,
			created_at = created_at
		)
}

//data class ListScheduleResponse(
//	val data: List<ScheduleDto>
//){
//	fun toModel(): List<Schedule> = data.map { it.toModel() }
//}

@JsonClass(generateAdapter = true)
data class ListScheduleResponse(
	@Json(name = "data") val data: List<Schedule>
)