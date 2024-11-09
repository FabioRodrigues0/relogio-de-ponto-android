package com.cesaepulse.app.domain.repository

import com.cesaepulse.app.domain.model.User

interface IUserRepository {

	fun getUserById(id: Int): User?

	fun getAllUsers(): List<User>
}