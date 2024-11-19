package com.cesaepulse.app.data.repository

import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
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

		return user
	}

	override suspend fun getAllUsers(): List<User> {
		var users: List<User> = emptyList()
		api.getAllUsers()
			.onSuccess {
				users = data.map { it.toModel() }
			}

		return users
	}
}