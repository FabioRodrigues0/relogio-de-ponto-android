package com.cesaepulse.app.data.mockRepositories

import com.cesaepulse.app.domain.model.User
import javax.inject.Inject

class MockUserRepo @Inject constructor() {
    lateinit var user: User
    var listUsers: ArrayList<User> = arrayListOf<User>()

    suspend fun getUserById(id: Int): User {

        user = User(
            id = 1,
            name = "User 1",
            email = "user1@email.com",
            foto= "https://picsum.photos/200/300?random=1",
            users_type_id = 1,
            setor = "admin");
        return user
    }

    suspend fun getAllUsers(): List<User> {
        for (i in 1..100) {
            listUsers.add(User(
                id = i,
                name = "User $i",
                email = "user$i@email.com",
                foto= "https://picsum.photos/200/300?random=$i",
                users_type_id = i,
                setor = "User"))
        }
        return listUsers
    }


}