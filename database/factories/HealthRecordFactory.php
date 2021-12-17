<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HealthRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'temperature' => $this->faker->numberBetween(10, 100),
            'blood_level' => $this->faker->numberBetween(10, 100),
            'sugar_level' => $this->faker->numberBetween(10, 100),
            'blood_pressure' => $this->faker->numberBetween(100, 200).'/'.$this->faker->numberBetween(100, 200),
            'patient_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
