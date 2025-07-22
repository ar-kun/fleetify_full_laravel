<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttendanceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to check relationship attendance belongs to an employee.
     */
    public function test_attendance_belongs_to_employee(): void
    {
        $attendance = Attendance::factory()->create();
        $this->assertTrue($attendance->employee->is($attendance->employee));
    }

    /**
     * A test to check relationship attendance has many attendance histories.
     */
    public function test_attendance_has_many_attendance_histories(): void
    {
        $attendance = Attendance::factory()->create();
        $attendanceHistories = AttendanceHistory::factory()->count(3)->create(['attendance_id' => $attendance->attendance_id]);

        $relatedAttendanceHistories = $attendance->attendanceHistories;
        $this->assertCount(3, $relatedAttendanceHistories);
        $this->assertTrue($relatedAttendanceHistories->contains($attendanceHistories->first()));
    }
}