package com.cesaepulse.app.domain.repository

import com.cesaepulse.app.domain.model.Schedule

interface IScheduleRepository {

	suspend fun getSchedulesById(id: Int, month: Int): List<Schedule?>
}