package com.cesaepulse.app.data.api

import com.cesaepulse.app.data.api.dto.UsersDto
import com.skydoves.sandwich.ApiResponse
import retrofit2.http.GET
import retrofit2.http.Path

interface CesaePulseApi {

	/**
	 *  Call Api to get All User
	 */
	@GET("/users")
	fun getAllUsers(): ApiResponse<List<UsersDto>>

	/**
	 *  Call Api to get One User by Id
	 *
	 *  @param id: Int
	 */
	@GET("/view_contact/{id}")
	fun getUserById(@Path("id") id: Int): ApiResponse<UsersDto>

	companion object {
		const val baseUrl = "https://jsonplaceholder.typicode.com"
	}
}