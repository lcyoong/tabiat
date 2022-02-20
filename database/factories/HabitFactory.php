<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hab_name' => $this->faker->sentence(),
        ];
    }
}
