<?php

namespace App\Http\Controllers;

use App\Models\AttendanceHistory;
use App\Models\Department;
use Illuminate\Http\Request;

class AttendanceHistoryController extends Controller
{
    public function index()
    {
        $attendanceHistory = AttendanceHistory::with('employee')
            ->when(request('search'), function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
            })
            ->when(request('department_id'), function ($query) {
                $query->whereHas('employee', function ($q) {
                    $q->where('department_id', request('department_id'));
                });
            })
            ->when(request('date_attendance'), function ($query) {
                $query->whereDate('date_attendance', request('date_attendance'));
            })
            ->latest()
            ->paginate(10);

        $departments = Department::all();

        return view('attendanceHistory.index', compact('attendanceHistory', 'departments'));
    }
}
