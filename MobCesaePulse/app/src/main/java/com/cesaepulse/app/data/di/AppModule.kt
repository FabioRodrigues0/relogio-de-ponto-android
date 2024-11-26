package com.cesaepulse.app.data.di

import com.cesaepulse.app.data.api.CesaePulseApi
import com.cesaepulse.app.data.repository.ProfileRepository
import com.cesaepulse.app.data.repository.ScheduleRepository
import com.cesaepulse.app.data.repository.UserRepository
import com.cesaepulse.app.domain.repository.IProfileRepository
import com.cesaepulse.app.domain.repository.IScheduleRepository
import com.cesaepulse.app.domain.repository.IUserRepository
import com.skydoves.sandwich.retrofit.adapters.ApiResponseCallAdapterFactory
import com.squareup.moshi.Moshi
import com.squareup.moshi.kotlin.reflect.KotlinJsonAdapterFactory
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.components.SingletonComponent
import retrofit2.Retrofit
import retrofit2.converter.moshi.MoshiConverterFactory
import javax.inject.Singleton

@Module
@InstallIn(SingletonComponent::class)
object AppModule {

	@Provides
	@Singleton
	fun provideMoshi(): Moshi =
		Moshi.Builder()
			.add(KotlinJsonAdapterFactory())
			.build()

	@Provides
	@Singleton
	fun provideCesaePulseApi(moshi: Moshi): CesaePulseApi =
		Retrofit.Builder()
			.baseUrl(CesaePulseApi.baseUrl)
			.addConverterFactory(MoshiConverterFactory.create(moshi))
			.addCallAdapterFactory(ApiResponseCallAdapterFactory.create())
			.build()
			.create(CesaePulseApi::class.java)

	@Singleton
	@Provides
	fun provideUserRepository(api: CesaePulseApi): IUserRepository =
		UserRepository(api = api)

	@Singleton
	@Provides
	fun provideProfileRepository(api: CesaePulseApi): IProfileRepository =
		ProfileRepository(api = api)

	@Singleton
	@Provides
	fun provideScheduleRepository(api: CesaePulseApi): IScheduleRepository =
		ScheduleRepository(api = api)
}