package com.cesaepulse.app.data.auth

import android.content.Context
import android.content.SharedPreferences
import com.cesaepulse.app.domain.model.User
import com.squareup.moshi.Moshi
import dagger.hilt.android.qualifiers.ApplicationContext
import javax.inject.Inject
import javax.inject.Singleton

@Singleton
class SessionManager @Inject constructor(
	@ApplicationContext context: Context,
	private val moshi: Moshi
) {
	private val prefs: SharedPreferences = context.getSharedPreferences(PREF_NAME, Context.MODE_PRIVATE)
	private val editor = prefs.edit()

	fun saveToken(token: String) {
		editor.putString(KEY_TOKEN, token).apply()
	}

	fun getToken(): String? {
		return prefs.getString(KEY_TOKEN, null)
	}

	fun saveUser(user: User) {
		val userJson = moshi.adapter(User::class.java).toJson(user)
		editor.putString(KEY_USER, userJson).apply()
	}

	fun getUser(): User? {
		val userJson = prefs.getString(KEY_USER, null)
		return userJson?.let {
			moshi.adapter(User::class.java).fromJson(it)
		}
	}

	fun clearSession() {
		editor.clear().apply()
	}

	fun isLoggedIn(): Boolean {
		return getToken() != null
	}

	companion object {
		private const val PREF_NAME = "CesaePulsePrefs"
		private const val KEY_TOKEN = "token"
		private const val KEY_USER = "user"
	}
}