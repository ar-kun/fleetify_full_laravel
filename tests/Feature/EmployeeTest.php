<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user);
    }

    /**
     * A test to ensure the employee index page loads correctly.
     */
    public function test_employee_index_page_loads_correctly(): void
    {
        $response = $this->get(route('employees.index'));

        $response->assertStatus(200);
    }

    /**
     * A test to ensure the employee create page loads correctly.
     */
    public function test_employee_create_page_loads_correctly(): void
    {
        $response = $this->get(route('employees.create'));

        $response->assertStatus(200);
    }


    /**
     * A test to ensure a employee can be created successfully.
     */
    public function test_employee_can_be_created(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->post(route('employees.store'), $employee->toArray());

        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', $employee->toArray());
    }

    /**
     * A test to ensure the employee show page loads correctly.
     */
    public function test_employee_show_page_loads_correctly(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->get(route('employees.show', $employee));

        $response->assertStatus(200);
    }

    /**
     * A test to ensure the employee edit page loads correctly.
     */
    public function test_employee_edit_page_loads_correctly(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->get(route('employees.edit', $employee));

        $response->assertStatus(200);
    }

    /**
     * A test to ensure a employee can be updated successfully.
     */
    public function test_employee_can_be_updated(): void
    {
        $employee = Employee::factory()->create();

        $data = [
            'department_id' => Department::inRandomOrder()->first()->id,
            'name' => 'Updated Employee',
            'address' => '456 Updated Street',
            'employee_id' => $employee->employee_id,
        ];

        $response = $this->put(route('employees.update', $employee->employee_id), $data);

        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', $data);
    }


    /**
     * A test to ensure a employee can be deleted successfully.
     */
    public function test_employee_can_be_deleted(): void
    {
        $employee = Employee::factory()->create();

        $response = $this->delete(route('employees.destroy', $employee));

        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseMissing('employees', $employee->toArray());
    }
}
