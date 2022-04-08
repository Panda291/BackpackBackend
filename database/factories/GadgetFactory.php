<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GadgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'RFID' => $this->faker->uuid(),
            'in_backpack' => $this->faker->boolean()
        ];
    }
}
