<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with('employee')
            ->where('employee_id', auth()->user()->employee_id)
            ->latest()
            ->first();
        return view('dashboard', compact('attendance'));
    }
}
