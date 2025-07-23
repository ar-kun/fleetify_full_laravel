<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendanceIn(Request $request)
    {
        if (!$request->has('employee_id')) {
            return redirect()->back()->withErrors(['error' => 'Failed to check in. Please try again later.']);
        }

        $attendance = Attendance::create([
            'employee_id' => $request->input('employee_id'),
            'attendance_id' => uniqid('att_'),
            'clock_in' => now(),
            'clock_out' => null,
        ]);

        if (!$attendance) {
            return redirect()->back()->withErrors(['error' => 'Failed to check in. Please try again later.']);
        }

        AttendanceHistory::create([
            'employee_id' => $request->input('employee_id'),
            'attendance_id' => $attendance->attendance_id,
            'date_attendance' => now(),
            'attendance_type' => AttendanceHistory::CHECK_IN,
        ]);

        return redirect()->back()->with('success', 'Attendance checked in successfully.');
    }
}
