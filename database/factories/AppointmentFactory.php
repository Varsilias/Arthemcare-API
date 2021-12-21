<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'scheduled_at' => $this->faker->dateTime(new \DateTime()),
            'patient_id' => $this->faker->numberBetween(1, 10),
            'user_id' =>   $this->faker->numberBetween(1, 10)
        ];
    }
}
