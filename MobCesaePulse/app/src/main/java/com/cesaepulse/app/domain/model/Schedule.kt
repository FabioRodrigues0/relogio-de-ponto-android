package com.cesaepulse.app.domain.model

import java.sql.Time
import java.sql.Timestamp

/**
 *  Class of Schedule
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
data class Schedule(
	val id: Int,
	val morning_entry_time: Time,
	val morning_exit_time: Time,
	val afternoon_entry_time: Time,
	val afternoon_exit_time: Time,
	val user_id: Int,
	val created_at: Timestamp,
	val updated_at: Timestamp
)
