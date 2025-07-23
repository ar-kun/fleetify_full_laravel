<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('/departments', DepartmentController::class);
    Route::resource('/employees', EmployeeController::class);

    Route::post('/attendance_in', [AttendanceController::class, 'attendanceIn'])->name('attendance.in');
    Route::post('/attendance_out', [AttendanceController::class, 'attendanceOut'])->name('attendance.out');

    Route::get('/attendance_history', [AttendanceHistoryController::class, 'index'])->name('attendance.history');
});

require __DIR__.'/auth.php';
