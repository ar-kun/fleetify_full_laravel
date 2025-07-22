<?php

namespace Tests\Feature\Models;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A test to check relationship departments has many to employees.
     */
    public function test_department_has_many_employees(): void
    {
        $department = Department::factory()->create();
        $employees = Employee::factory()->count(3)->create(['department_id' => $department->id]);

        $relatedEmployees = $department->employees;
        $this->assertCount(3, $relatedEmployees);
        $this->assertTrue($relatedEmployees->contains($employees->first()));
    }
}