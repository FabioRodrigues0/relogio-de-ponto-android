package com.cesaepulse.app.data.repository

import android.content.ContentValues.TAG
import android.util.Log
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.Schedule
import com.cesaepulse.app.domain.repository.IScheduleRepository
import com.skydoves.sandwich.onError
import com.skydoves.sandwich.onException
import com.skydoves.sandwich.onSuccess
import javax.inject.Inject

class ScheduleRepository @Inject constructor(
	private val api: CesaePulseApi
) : IScheduleRepository {

	override suspend fun getSchedulesById(id: Int, month: Int): List<Schedule?> {
		var schedules: List<Schedule> = emptyList()
		api.getSchedulesByUserId(id, month)
			.onSuccess {
				Log.d("getSchedulesById", "success")
				schedules = data.data
			}
			.onError {
				Log.e(TAG, "Fail ou getting all schedules from user")
			}
			.onException {
				Log.d("getSchedulesById", "exception - ${this.message}")
			}

		return schedules
	}
}