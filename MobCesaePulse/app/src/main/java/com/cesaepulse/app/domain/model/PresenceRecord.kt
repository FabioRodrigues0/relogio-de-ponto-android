package com.cesaepulse.app.domain.model

import java.sql.Time

data class PresenceRecord(
	val date: Time,
	val entry_time: Time,
	val exit_time: Time?,
	val attendance_mode: AttendanceMode,
)
