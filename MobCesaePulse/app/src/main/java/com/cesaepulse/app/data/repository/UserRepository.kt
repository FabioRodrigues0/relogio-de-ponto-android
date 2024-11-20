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

	override suspend fun getUserById(id: Int): User? {
		var user: User? = null
		api.getUserById(id)
			.onSuccess {
				user = data.toModel()
			}
			.onError {
				Log.e(TAG, "Fail ou getting user {$id}")
			}
			.onException {
				Log.d("getUserById", "exception - ${this.message}")
			}

		return user
	}

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
}