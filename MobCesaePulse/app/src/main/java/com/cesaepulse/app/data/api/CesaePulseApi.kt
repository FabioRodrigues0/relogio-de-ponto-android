package com.cesaepulse.app.data.api

import com.cesaepulse.app.data.api.dto.ListScheduleResponse
import com.cesaepulse.app.data.api.dto.ListUserResponse
import com.cesaepulse.app.data.api.dto.LoginResponse
import com.cesaepulse.app.data.api.dto.LogoutResponse
import com.cesaepulse.app.data.api.dto.ProfileResponse
import com.skydoves.sandwich.ApiResponse
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.GET
import retrofit2.http.POST
import retrofit2.http.Path

interface CesaePulseApi {

	// ----------------	USER ---------------------------

	/**
	 *  Call Api to get All User
	 */
	@GET("users/")
	suspend fun getAllUsers(): ApiResponse<ListUserResponse>

	/**
	 *  Call Api to get One User by Id
	 *
	 *  @param id: Int
	 */
	@GET("profile/{id}")
	suspend fun getProfileById(@Path("id") id: Int): ApiResponse<ProfileResponse>

	/**
	 *  Call Api to check-in Entrance
	 *
	 *  @param id: Int
	 */
	@GET("checkin/{id}/{type}")
	suspend fun postCheckIn(@Path("id") id: Int, @Path("type") type: Int): ApiResponse<Void>


	/**
	 *  Call Api to check-out Entrance
	 *
	 *  @param id: Int
	 */
	@GET("checkout/{id}")
	suspend fun postCheckOut(@Path("id") id: Int): ApiResponse<Void>

	/**
	 *  Call Api to login
	 *
	 */
	@FormUrlEncoded
	@POST("login")
	suspend fun login(@Field("email") email: String, @Field("password") password: String): ApiResponse<LoginResponse>

	/**
	 *  Call Api to logout
	 *
	 */
	@POST("logout/{id}")
	suspend fun logout(@Path("id") id: Int): ApiResponse<LogoutResponse>

	// ------------------ SCHEDULE -----------------------

	/**
	 *  Call Api to get One Shedules from one User by Id
	 *
	 *  @param id: Int
	 *  @param month: Int
	 *
	 */
	@GET("schedule/{id}/{month}")
	suspend fun getSchedulesByUserId(@Path("id") id: Int, @Path("month") month: Int): ApiResponse<ListScheduleResponse>


	companion object {
		const val baseUrl = "https://formacaocesae.pt/Reskilling/2024/WEMD01PRT/TeamJF/public/api/"
		const val urlImage = "https://formacaocesae.pt/Reskilling/2024/WEMD01PRT/TeamJF/public/images/"
	}
}