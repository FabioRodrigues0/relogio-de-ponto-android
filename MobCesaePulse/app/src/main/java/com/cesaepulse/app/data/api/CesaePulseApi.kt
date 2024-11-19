package com.cesaepulse.app.data.api

import com.cesaepulse.app.data.api.dto.UsersDto
import com.skydoves.sandwich.ApiResponse
import retrofit2.http.GET
import retrofit2.http.Path

interface CesaePulseApi {

	// ----------------	USER ---------------------------

	/**
	 *  Call Api to get All User
	 */
	@GET("/users")
	suspend fun getAllUsers(): ApiResponse<List<UsersDto>>

	/**
	 *  Call Api to get One User by Id
	 *
	 *  @param id: Int
	 */
	@GET("/users/{id}")
	suspend fun getUserById(@Path("id") id: Int): ApiResponse<UsersDto>

	// ------------------ JUSTIFICATION -----------------------

	companion object {
		const val baseUrl = "https://formacaocesae.pt/Reskilling/2024/WEMD01PRT/TeamJF/public/api"
	}
}