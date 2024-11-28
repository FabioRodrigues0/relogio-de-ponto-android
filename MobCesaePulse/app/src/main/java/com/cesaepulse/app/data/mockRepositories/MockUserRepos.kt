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
    private var listUsers: ArrayList<User> = arrayListOf()

    private val _profile = MutableStateFlow<Profile?>(null)
    val profile = _profile.asStateFlow()

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

        _profile.value = Profile(
            id = 16,
            name = "Joana",
            email = "joana@cesae.pt",
            foto = "uploadedImages/rxbAqvWZQqWvFcOxXgJYPgDw1IhebfcSlzaL79GP.png",
            setor = "Laravel",
            user_type = "Admin",
            presences = mockPresences
        )
    }

    fun getProfileById(id: Int): Profile? {
        return _profile.value
    }

    suspend fun getAllUsers(): List<User> {
        listUsers.clear()
        for (i in nomes.indices) {
            listUsers.add(User(
                id = i + 1,
                name = nomes[i],
                email = "${nomes[i].lowercase()}@email.com",
                foto = "https://picsum.photos/200/300?random=${i + 1}",
                users_type_id = i + 1,
                setor = if ((i + 1) % 2 != 0) "admin" else "user"
            ))
        }
        return listUsers
    }
}