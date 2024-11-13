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
	@GET("/users?token=&key=${secretKey}")
	suspend fun getAllUsers(): ApiResponse<List<UsersDto>>

	/**
	 *  Call Api to get One User by Id
	 *
	 *  @param id: Int
	 */
	@GET("/view_contact/{id}?token=&key=${secretKey}")
	suspend fun getUserById(@Path("id") id: Int): ApiResponse<UsersDto>

	// ------------------ JUSTIFICATION -----------------------

	companion object {
		const val baseUrl = "https://gawbignbvttgvuipsakm.supabase.co"
		const val secretKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imdhd2JpZ25idnR0Z3Z1aXBzYWttIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzE0MjMxODMsImV4cCI6MjA0Njk5OTE4M30.LP-IAQUBJ060Ib8W3kPohoMcd7zuzbYUFzcPVi-A6qA"
	}
}