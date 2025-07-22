<?php

namespace Tests\Feature\Models;

use App\Models\AttendanceHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_attendance_history_belongs_to_attendance(): void
    {
        $attendanceHistory = AttendanceHistory::factory()->create();
        $this->assertTrue($attendanceHistory->attendance->is($attendanceHistory->attendance));
    }

    /**
     * A test to check relationship attendance history belongs to an employee.
     */
    public function test_attendance_history_belongs_to_employee(): void
    {
        $attendanceHistory = AttendanceHistory::factory()->create();
        $this->assertTrue($attendanceHistory->employee->is($attendanceHistory->employee));
    }
}