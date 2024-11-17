package com.cesaepulse.app.data.mockRepositories

import com.cesaepulse.app.domain.model.User
import com.cesaepulse.app.domain.repository.IUserRepository
import javax.inject.Inject

class MockUserRepo @Inject constructor() : IUserRepository {
    lateinit var user: User
    var listUsers: ArrayList<User> = arrayListOf<User>()

    override suspend fun getUserById(id: Int): User {

        user = User(
            id = 1,
            name = "User 1",
            email = "user1@email.com",
            photo= "https://picsum.photos/200/300?random=1",
            email_verified_at = "verified",
            sector = "admin");
        return user
    }

    override suspend fun getAllUsers(): List<User> {
        for (i in 1..100) {
            listUsers.add(User(
                id = i,
                name = "User $i",
                email = "user$i@email.com",
                photo= "https://picsum.photos/200/300?random=$i",
                email_verified_at = "verified",
                sector = "User"))
        }
        return listUsers
    }


}