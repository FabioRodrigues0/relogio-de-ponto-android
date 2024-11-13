package com.cesaepulse.app.domain.repository

import com.cesaepulse.app.domain.model.User

interface IUserRepository {

	suspend fun getUserById(id: Int): User?

	suspend fun getAllUsers(): List<User>
}