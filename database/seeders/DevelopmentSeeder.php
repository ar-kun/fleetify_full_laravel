<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->count(5)->create();
        Employee::factory()->count(10)->create();
        Attendance::factory()->count(10)->create();
        AttendanceHistory::factory()->count(10)->create();

        User::all()->each(function ($user) {
            $employee = Employee::inRandomOrder()->first();
            $user->employee_id = $employee->employee_id;
            $user->save();
        });
    }
}
