<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => "content",
            'type' => $this->faker->randomElement([1, 2]),
            'phone' => $this->faker->randomNumber,
            'project' => $this->faker->sentence,
            'reason' => $this->faker->sentence,
            'status' => 1,
        ];
    }
}
