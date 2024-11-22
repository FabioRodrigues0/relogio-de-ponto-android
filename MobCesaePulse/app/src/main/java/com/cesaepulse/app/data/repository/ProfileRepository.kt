package com.cesaepulse.app.data.repository

import android.content.ContentValues.TAG
import android.util.Log
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.repository.IProfileRepository
import com.skydoves.sandwich.onError
import com.skydoves.sandwich.onException
import com.skydoves.sandwich.onSuccess
import javax.inject.Inject

class ProfileRepository @Inject constructor(
	private val api: CesaePulseApi
) : IProfileRepository {

	override suspend fun getProfileById(id: Int): Profile? {
		var profile: Profile? = null
		api.getProfileById(id)
			.onSuccess {
				Log.d("getProfileById", "success")
				profile = data.toModel()
			}
			.onError {
				Log.e(TAG, "Fail ou getting user {$id}")
			}
			.onException {
				Log.d("getUserById", "exception - ${this.message}")
			}

		return profile
	}
}