<?php

namespace Tests\Feature\Models;

use App\Models\Attendance;
use App\Models\AttendanceHistory;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to check relationship employees belongs to a department.
     */
    public function test_employee_belongs_to_department(): void
    {
        $department = Department::factory()->create();
        $employee = Employee::factory()->create(['department_id' => $department->id]);

        $this->assertTrue($employee->department->is($department));
    }

    /**
     * A test to check relationship employees has many attendance histories.
     */
    public function test_employee_has_many_attendance_histories(): void
    {
        $employee = Employee::factory()->create();
        $attendanceHistories = AttendanceHistory::factory()->count(3)->create(['employee_id' => $employee->employee_id]);

        $relatedAttendanceHistories = $employee->attendanceHistories;
        $this->assertCount(3, $relatedAttendanceHistories);
        $this->assertTrue($relatedAttendanceHistories->contains($attendanceHistories->first()));
    }

    /**
     * A test to check relationship employees has many attendances.
     */
    public function test_employee_has_many_attendances(): void
    {
        $employee = Employee::factory()->create();
        $attendances = Attendance::factory()->count(3)->create(['employee_id' => $employee->employee_id]);

        $relatedAttendances = $employee->attendances;
        $this->assertCount(3, $relatedAttendances);
        $this->assertTrue($relatedAttendances->contains($attendances->first()));
    }
}
