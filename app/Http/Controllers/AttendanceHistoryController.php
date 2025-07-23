<?php

namespace App\Http\Controllers;

use App\Models\AttendanceHistory;
use Illuminate\Http\Request;

class AttendanceHistoryController extends Controller
{
    public function index()
    {
        $attendanceHistory = AttendanceHistory::with('employee')
            ->latest()
            ->paginate(10);

        return view('attendanceHistory.index', compact('attendanceHistory'));
    }
}
