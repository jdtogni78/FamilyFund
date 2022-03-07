<?php

namespace Database\Factories;

use App\Models\SymbolPosition;
use Illuminate\Database\Eloquent\Factories\Factory;

class SymbolPositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SymbolPosition::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'type' => $this->faker->word,
        'position' => $this->faker->randomDigitNotNull
        ];
    }
}
