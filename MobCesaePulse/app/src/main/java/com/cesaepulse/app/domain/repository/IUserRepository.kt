package com.cesaepulse.app.domain.repository

import com.cesaepulse.app.domain.model.User

interface IUserRepository {

	suspend fun getAllUsers(): List<User>

	suspend fun postCheckIn(id: Int, type: Int): Boolean

	suspend fun postCheckOut(id: Int): Boolean

	suspend fun login(email: String, password: String): Boolean

	suspend fun logout(id: Int): Boolean
}