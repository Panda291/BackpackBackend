<?php

namespace Database\Factories;

use App\Models\Gadget;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaticNeedFactory extends Factory
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
            'needed_on' => $this->faker->dateTimeBetween($startDate = '-3 weeks', $endDate = '+3 weeks'),
        ];
    }
}
