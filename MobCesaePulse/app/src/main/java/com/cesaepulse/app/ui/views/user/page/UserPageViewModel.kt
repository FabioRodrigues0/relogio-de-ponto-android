package com.cesaepulse.app.ui.views.user.page

import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.cesaepulse.app.domain.model.PresenceRecord
import com.cesaepulse.app.domain.model.Profile
import com.cesaepulse.app.domain.repository.IProfileRepository
import dagger.hilt.android.lifecycle.HiltViewModel
import kotlinx.coroutines.flow.MutableStateFlow
import kotlinx.coroutines.flow.asStateFlow
import kotlinx.coroutines.flow.update
import kotlinx.coroutines.launch
import java.text.SimpleDateFormat
import java.time.Instant.now
import java.util.Date
import javax.inject.Inject
import kotlin.time.Duration
import kotlin.time.Duration.Companion.milliseconds

@HiltViewModel
class UsersPageViewModel @Inject constructor(
    private val repository: IProfileRepository
)  : ViewModel() {

    private var _profile = MutableStateFlow<Profile?>(null)
    val profile = _profile.asStateFlow()

    private var _hoursDay = MutableStateFlow<String>("0")
    val hoursDay = _hoursDay.asStateFlow()

    private var _hoursWeek = MutableStateFlow<String>("0")
    val hoursWeek = _hoursWeek.asStateFlow()

    private var _hoursMonth = MutableStateFlow<String>("0")
    val hoursMonth = _hoursMonth.asStateFlow()

    private var _lastPresence = MutableStateFlow<String>("0000-00-00")
    val lastPresence = _lastPresence.asStateFlow()

    fun fetchUser(id: Int) {
        viewModelScope.launch {
            _profile.update { repository.getProfileById(id) }
            _hoursDay.update { calculateHoursDay() }
            _hoursWeek.update { calculateHoursWeek() }
            _hoursMonth.update { calculateHoursMonth() }
            _lastPresence.update { calculateLastPresence() }
        }
    }

    fun calculateHoursDay(): String {
        if (profile.value != null && profile.value?.presences != emptyList<PresenceRecord>()) {
            var difference: Long = 0;
            val filterPresences = profile.value?.presences?.filter{ presences ->
                presences.date.equals(now().toString().split('T')[0])
            }

            filterPresences?.map { presence ->
                val format: SimpleDateFormat = SimpleDateFormat("HH:mm:ss");
                val entry_time: Date = format.parse(presence.entry_time.toString());
                val exit_time: Date = format.parse(presence.exit_time.toString());
                difference = exit_time.getTime() - entry_time.getTime();

            }
            if (filterPresences != null) {
                val hours: Duration = difference.milliseconds
                return hours.inWholeHours.toString()
            }
        }
        return "0"
    }
    fun calculateHoursWeek(): String {
        if (profile.value != null && profile.value?.presences != emptyList<PresenceRecord>()) {
            val formatWeek: SimpleDateFormat = SimpleDateFormat("WW");
            var difference: Long = 0;
            val filterPresences = profile.value?.presences?.filter{ presences ->
                formatWeek.parse(presences.date.toString()) == formatWeek.parse(now().toString().split('T')[0])
            }

            filterPresences?.map { presence ->
                val formatHour: SimpleDateFormat = SimpleDateFormat("HH:mm:ss");
                val entry_time: Date = formatHour.parse(presence.entry_time.toString());
                val exit_time: Date = formatHour.parse(presence.exit_time.toString());
                difference += exit_time.getTime() - entry_time.getTime();

            }
            if (filterPresences != null) {
                val hours: Duration = difference.milliseconds
                return hours.inWholeHours.toString()
            }
        }
        return "0"
    }
    fun calculateHoursMonth(): String {
        if (profile.value != null && profile.value?.presences != emptyList<PresenceRecord>()) {
            val formatMonth: SimpleDateFormat = SimpleDateFormat("MM");
            var difference: Long = 0;
            val filterPresences = profile.value?.presences?.filter{ presences ->
                formatMonth.parse(presences.date.toString()) == formatMonth.parse(now().toString().split('T')[0])
            }

            filterPresences?.map { presence ->
                val formatHour: SimpleDateFormat = SimpleDateFormat("HH:mm:ss");
                val entry_time: Date = formatHour.parse(presence.entry_time.toString());
                val exit_time: Date = formatHour.parse(presence.exit_time.toString());
                difference += exit_time.getTime() - entry_time.getTime();

            }
            if (filterPresences != null) {
                val hours: Duration = difference.milliseconds
                return hours.inWholeHours.toString()
            }
        }
        return "0"
    }

    fun calculateLastPresence(): String {
        if (profile.value != null && profile.value?.presences != emptyList<PresenceRecord>()) {
            val sortedPresences = profile.value?.presences?.sortedByDescending { it.date }
            return sortedPresences?.first()?.date.toString()
        }
        return "0000-00-00"
    }

}