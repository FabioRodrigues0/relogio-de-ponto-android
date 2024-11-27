package com.cesaepulse.app.domain.model

data class PresenceRecord(
	val date: String,
	val entry_time: String,
	val exit_time: String?,
	val attendance_mode: AttendanceMode,
)
