<?php

namespace Database\Factories;

use App\Models\Gadget;
use Illuminate\Database\Eloquent\Factories\Factory;

class DynamicNeedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gadget_id' => $this->faker->randomElement(Gadget::all())->id,
            'day_of_week' => $this->faker->numberBetween(0, 6),
        ];
    }
}
