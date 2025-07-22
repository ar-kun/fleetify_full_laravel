<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceHistory>
 */
class AttendanceHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\Employee::inRandomOrder()->first()->employee_id ?? \App\Models\Employee::factory()->create()->employee_id,
            'attendance_id' => \App\Models\Attendance::inRandomOrder()->first()->attendance_id ?? \App\Models\Attendance::factory()->create()->attendance_id,
            'date_attendance' => $this->faker->dateTimeThisYear(),
            'attendance_type' => $this->faker->numberBetween(1, 2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}