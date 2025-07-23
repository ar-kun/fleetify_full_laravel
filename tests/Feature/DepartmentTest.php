<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
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
     * A test to ensure the department index page loads correctly.
     */
    public function test_department_index_page_loads_correctly(): void
    {
        $response = $this->get(route('departments.index'));

        $response->assertStatus(200);
    }

    /**
     * A test to ensure the department create page loads correctly.
     */
    public function test_department_create_page_loads_correctly(): void
    {
        $response = $this->get(route('departments.create'));

        $response->assertStatus(200);
    }

    /**
     * A test to ensure a department can be created successfully.
     */
    public function test_department_can_be_created(): void
    {
        $data = [
            'department_name' => 'Test Department',
            'max_clock_in_time' => '09:00',
            'max_clock_out_time' => '17:00',
        ];

        $response = $this->post(route('departments.store'), $data);

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseHas('departments', $data);
    }

    /**
     * A test to ensure the department show page loads correctly.
     */
    public function test_department_show_page_loads_correctly(): void
    {
        $department = \App\Models\Department::factory()->create();

        $response = $this->get(route('departments.show', $department));

        $response->assertStatus(200);
        $response->assertViewHas('department', $department);
    }

    /**
     * A test to ensure the department edit page loads correctly.
     */
    public function test_department_edit_page_loads_correctly(): void
    {
        $department = \App\Models\Department::factory()->create();

        $response = $this->get(route('departments.edit', $department));

        $response->assertStatus(200);
        $response->assertViewHas('department', $department);
    }

    /**
     * A test to ensure a department can be updated successfully.
     */
    public function test_department_can_be_updated(): void
    {
        $department = \App\Models\Department::factory()->create();

        $data = [
            'department_name' => 'Updated Department',
            'max_clock_in_time' => '08:00',
            'max_clock_out_time' => '16:00',
        ];

        $response = $this->put(route('departments.update', $department), $data);

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseHas('departments', $data);
    }

    /**
     * A test to ensure a department can be deleted successfully.
     */
    public function test_department_can_be_deleted(): void
    {
        $department = \App\Models\Department::factory()->create();

        $response = $this->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
