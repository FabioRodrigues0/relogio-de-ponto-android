package com.cesaepulse.app.domain.model

/**
 *  Class of Schedule
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
data class Schedule(
	val id: Int,
	val morning_entry_time: String,
	val morning_exit_time: String,
	val afternoon_entry_time: String,
	val afternoon_exit_time: String,
	var attendance_mode_id: Int,
	val user_id: Int,
	val created_at: String
)
