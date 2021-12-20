<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'prescription' => $this->faker->paragraph(),
            'comment_by_doctor' => $this->faker->paragraph(),
            'patient_id' => $this->faker->numberBetween(1, 10),
            'user_id' =>   $this->faker->numberBetween(1, 10)
        ];
    }
}
