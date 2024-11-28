package com.cesaepulse.app.ui.views.calendar.dialog

import androidx.compose.foundation.layout.Column
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import com.cesaepulse.app.domain.model.Schedule
import com.cesaepulse.app.ui.views.calendar.models.CalendarDay
import java.util.Calendar

@Composable
fun CalendarDayDetails(schedule: Schedule?){
    Column {
        if (schedule != null) {
            Text(text = schedule.created_at)
            Text(text = schedule.morning_entry_time)
            Text(text = schedule.morning_exit_time)
            Text(text = schedule.afternoon_entry_time)
            Text(text = schedule.afternoon_exit_time)
            Text(text = (if(schedule.attendance_mode_id == 1)  "Online" else "Presencial"))
        }
    }
}