<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceHistory;

class DashboardController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with('employee')
            ->where('employee_id', auth()->user()->employee_id)
            ->latest()
            ->first();

        $attendanceHistory = AttendanceHistory::with('employee')->where('employee_id', auth()->user()->employee_id)
            ->latest()->limit(6)
            ->get();

        return view('dashboard', compact('attendance', 'attendanceHistory'));
    }
}
