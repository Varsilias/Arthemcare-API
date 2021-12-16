<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $complexion = $this->faker->randomElement(['dark', 'fair', 'chocolate', 'ebony']);

        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->firstNameMale(),
            'DOB' => $this->faker->dateTime(),
            'phone_number' => $this->faker->randomNumber(8, true),
            'gender' => $gender,
            'complexion'=> $complexion,
            'ward_no' => $this->faker->randomNumber(5, true),
            'discharged' => $this->faker->boolean(),
        ];
    }
}
