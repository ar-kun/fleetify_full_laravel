<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_name' => $this->faker->company,
            'max_clock_in_time' => $maxClockInTime = $this->faker->time(),
            'max_clock_out_time' => (new \DateTime($maxClockInTime))->add(new \DateInterval('PT'.$this->faker->numberBetween(540, 600).'M'))->format('H:i:s'),
        ];
    }
}
