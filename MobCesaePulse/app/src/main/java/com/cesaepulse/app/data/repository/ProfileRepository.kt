package com.cesaepulse.app.data.repository

import android.content.ContentValues.TAG
import android.util.Log
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.repository.IProfileRepository
import com.skydoves.sandwich.onError
import com.skydoves.sandwich.onException
import com.skydoves.sandwich.onSuccess
import com.skydoves.sandwich.retrofit.statusCode
import javax.inject.Inject

class ProfileRepository @Inject constructor(
	private val api: CesaePulseApi
) : IProfileRepository {

	override suspend fun getProfileById(id: Int): Profile? {
		var profile: Profile? = null
		try {
			api.getProfileById(id)
				.onSuccess {
					Log.d("getProfileById", "success")
					profile = data.toModel()
				}
				.onError {
					Log.e(TAG, "Failed getting user $id: ${statusCode.code}")
					throw Exception("Failed to get profile: ${statusCode.code}")
				}
				.onException {
					Log.e(TAG, "Exception getting user $id: ${message}")
					throw Exception("Failed to get profile: $message")
				}
		} catch (e: Exception) {
			Log.e(TAG, "Error getting profile: ${e.message}")
			throw e
		}
		return profile
	}

}