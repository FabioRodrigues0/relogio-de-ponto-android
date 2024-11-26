package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.PresenceRecord
import java.sql.Time

/**
 *  Data Class of PresenceRecord
 *
 *  @param date: DateFormat
 *  @param entry_time: TimeSource
 *  @param exit_time: TimeSource?,
 *  @param attenance_mode: AttendanceModeDto
 */
data class PresenceRecordDto(
	val date: Time,
	val entry_time: Time,
	val exit_time: Time?,
	val attendance_mode: AttendanceModeDto,
) {
	/**
	 *  Convert UPresenceRecordDto to PresenceRecord
	 *
	 */
	fun toModel():  PresenceRecord =
		PresenceRecord(
			date = date,
			entry_time = entry_time,
			exit_time = exit_time,
			attendance_mode = attendance_mode.toModel()
		)
}
