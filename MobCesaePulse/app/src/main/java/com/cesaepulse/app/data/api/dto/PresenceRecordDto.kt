package com.cesaepulse.app.data.api.dto

import com.cesaepulse.app.domain.model.PresenceRecord

/**
 *  Data Class of PresenceRecord
 *
 *  @param date: DateFormat
 *  @param entry_time: TimeSource
 *  @param exit_time: TimeSource?,
 *  @param attenance_mode: AttendanceModeDto
 */
data class PresenceRecordDto(
	val date: String,
	val entry_time: String,
	val exit_time: String?,
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
