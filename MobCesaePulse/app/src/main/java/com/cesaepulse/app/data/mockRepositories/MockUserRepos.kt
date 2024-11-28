package com.cesaepulse.app.data.mockRepositories

import com.cesaepulse.app.domain.model.AttendanceMode
import com.cesaepulse.app.domain.model.PresenceRecord
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.model.User
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import javax.inject.Inject
import javax.inject.Singleton

@Singleton
class MockUserRepo @Inject constructor() {
    private var isCheckedIn = false
    private val nomes = listOf("Joana", "Maria", "Fabio", "Sara", "Joaquim")
    private var listUsers: List<User> = emptyList()

    private val _profile: Profile

    init {
        val mockPresences = listOf(
            PresenceRecord(
                date = "2024-11-18",
                entry_time = "09:02:13",
                exit_time = "19:02:13",
                attendance_mode = AttendanceMode(2, "In-Person")
            ),
            PresenceRecord(
                date = "2024-11-17",
                entry_time = "08:52:13",
                exit_time = "17:01:02",
                attendance_mode = AttendanceMode(1, "Remote")
            ),
            PresenceRecord(
                date = "2024-11-16",
                entry_time = "09:00:01",
                exit_time = "17:00:02",
                attendance_mode = AttendanceMode(1, "Remote")
            )
        )

        _profile = Profile(
            id = 16,
            name = "Joana",
            email = "joana@cesae.pt",
            foto = "uploadedImages/rxbAqvWZQqWvFcOxXgJYPgDw1IhebfcSlzaL79GP.png",
            setor = "Laravel",
            user_type = "Admin",
            presences = mockPresences
        )
    }

    fun getProfileById(id: Int): Profile {
        return _profile
    }

    suspend fun getAllUsers(): List<User> {
        listUsers = listOf(
            User(
                id = 1,
                name = "Joana",
                email = "joana@email.com",
                foto = "https://picsum.photos/200/300?random=1}",
                users_type_id = 1,
                setor = "admin"
            ),
            User(
                id = 2,
                name = "Maria",
                email = "maria@email.com",
                foto = "https://picsum.photos/200/300?random=2",
                users_type_id = 2,
                setor = "admin"
            ),
            User(
                id = 3,
                name = "Fabio",
                email = "fabio@email.com",
                foto = "https://picsum.photos/200/300?random=3",
                users_type_id = 1,
                setor = "admin"
            ),
            User(
                id = 4,
                name = "Sara",
                email = "joana@email.com",
                foto = "https://picsum.photos/200/300?random=4",
                users_type_id = 1,
                setor = "admin"
            ),
            User(
                id = 5,
                name = "Joaquim",
                email = "joana@email.com",
                foto = "https://picsum.photos/200/300?random=5",
                users_type_id = 2,
                setor = "admin"
            )
        )

        return listUsers
    }
}