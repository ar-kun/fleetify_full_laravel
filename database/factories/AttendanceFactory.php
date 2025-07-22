<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'attendance_id' => $this->faker->unique()->uuid,
            'clock_in' => $clockIn = $this->faker->dateTimeBetween('-10 hours', 'now'),
            'clock_out' => $this->faker->dateTimeBetween($clockIn, $clockIn->modify('+10 hours')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}