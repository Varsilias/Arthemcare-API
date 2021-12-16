<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NextOfKinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->firstNameMale(),
            'DOB' => $this->faker->dateTime(),
            'phone_number' => $this->faker->randomNumber(8, true),
            'gender' => $gender,
            'email' => $this->faker->unique()->safeEmail(),
            'patient_id' => $this->faker->numberBetween(1, 10)

        ];
    }
}
