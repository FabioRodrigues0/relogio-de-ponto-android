package com.cesaepulse.app.data.repository

import android.content.ContentValues.TAG
import android.util.Log
import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.data.auth.SessionManager
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
import com.skydoves.sandwich.onError
import com.skydoves.sandwich.onException
import com.skydoves.sandwich.onSuccess
import com.skydoves.sandwich.retrofit.statusCode
import javax.inject.Inject

class UserRepository @Inject constructor(
	private val api: CesaePulseApi,
	private val sessionManager: SessionManager
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

	override suspend fun login(email: String, password: String): Boolean {
		var result = false
		try {
			Log.d("RUN LOGIN: login -> : ", "try")
			api.login(email, password).onSuccess {
					Log.d("RUN LOGIN:", "Login successful: ${data.message}")
					sessionManager.saveToken(data.session.token)
					sessionManager.saveUser(data.user)
					result = true
				}
				.onError {
					Log.e(TAG, "RUN LOGIN: failed: ${statusCode.code}")
					throw Exception("RUN LOGIN failed: Invalid credentials")
				}
				.onException {
					Log.e(TAG, "RUN LOGIN exception: ${message}")
					throw Exception("RUN LOGIN failed: ${message}")
				}
		} catch (e: Exception) {
			Log.e(TAG, "RUN LOGIN error: ${e.message}")
			throw e
		}
		return result
	}

	override suspend fun logout(id: Int) : Boolean {
		var result = false
		api.logout(id)
			.onSuccess {
				Log.d("logout", "Logout successful: ${data.message}")
				sessionManager.clearSession()
				result = true
			}
			.onError {
				Log.e(TAG, "Logout failed: ${statusCode.code}")
				result = false
				throw Exception("Logout failed")
			}
			.onException {
				Log.e(TAG, "Logout exception: ${message}")
				result = false
				throw Exception("Logout failed: ${message}")
			}
		return result
	}
}