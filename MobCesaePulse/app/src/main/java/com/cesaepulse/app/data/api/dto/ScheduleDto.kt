package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.Schedule
import java.sql.Time
import java.sql.Timestamp

/**
 *  Class of ScheduleDto
 *
 *  @param id: Int
 *  @param morning_entry_time: Time
 *  @param morning_exit_time: Time
 *  @param afternoon_entry_time: Time
 *  @param afternoon_exit_time: Time
 *  @param user_id: Int
 *  @param created_at: Timestamp
 *  @param updated_at: Timestamp
 *
 */
data class ScheduleDto(
	val id: Int,
	val morning_entry_time: Time,
	val morning_exit_time: Time,
	val afternoon_entry_time: Time,
	val afternoon_exit_time: Time,
	val user_id: Int,
	val created_at: Timestamp,
	val updated_at: Timestamp
){
	/**
	 *  Convert ScheduleDto to Schedule
	 *
	 */
	fun toModel():  Schedule =
		Schedule(
			id= id,
			morning_entry_time = morning_entry_time,
			morning_exit_time = morning_exit_time,
			afternoon_entry_time = afternoon_entry_time,
			afternoon_exit_time = afternoon_exit_time,
			user_id = user_id,
			created_at = created_at,
			updated_at = updated_at
		)
}

data class ListScheduleResponse(
	val data: List<ScheduleDto>
){
	fun toModel(): List<Schedule> = data.map { it.toModel() }
}
