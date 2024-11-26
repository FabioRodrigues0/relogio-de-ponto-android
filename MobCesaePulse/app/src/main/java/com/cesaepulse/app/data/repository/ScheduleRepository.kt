package com.cesaepulse.app.data.repository

import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.Schedule
import com.cesaepulse.app.domain.repository.IScheduleRepository
import javax.inject.Inject

class ScheduleRepository @Inject constructor(
	private val api: CesaePulseApi
) : IScheduleRepository {

	override suspend fun getSchedulesById(id: Int): List<Schedule?> {
		TODO("Not yet implemented")
	}
}