package com.cesaepulse.app.domain.repository

import com.cesaepulse.app.domain.model.Profile

interface IProfileRepository {

	suspend fun getProfileById(id: Int): Profile?


}