package com.cesaepulse.app.data.repository

import android.content.ContentValues.TAG
import android.util.Log
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
import com.skydoves.sandwich.onError
import com.skydoves.sandwich.onException
import com.skydoves.sandwich.onSuccess
import javax.inject.Inject

class UserRepository @Inject constructor(
	private val api: CesaePulseApi
) : IUserRepository {

	override suspend fun getAllUsers(): List<User> {
		var users: List<User> = emptyList()
		api.getAllUsers()
			.onSuccess {
				Log.d("getAllUsers", "success")
				users = data.toModel()
			}
			.onError {
				Log.e(TAG, "Fail ou getting all users")
			}
			.onException {
				Log.d("getAllUsers", "exception - ${this.message}")
			}

		return users
	}

	override suspend fun postCheckIn(id: Int, type: Int): Boolean {
		var result: Boolean = false
		api.postCheckIn(id, type)
			.onSuccess {
				Log.d("postCheckIn", "success")
				result = true
			}
			.onError {
				Log.e(TAG, "Fail on check-in")
				result = false
			}
			.onException {
				Log.d("postCheckIn", "exception - ${this.message}")
				result = false
			}
		return result
	}

	override suspend fun postCheckOut(id: Int): Boolean {
		var result: Boolean = false
		api.postCheckOut(id)
			.onSuccess {
				Log.d("postCheckIn", "success")
				result = true
			}
			.onError {
				Log.e(TAG, "Fail on check-in")
				result = false
			}
			.onException {
				Log.d("postCheckIn", "exception - ${this.message}")
				result = false
			}
		return result
	}
}