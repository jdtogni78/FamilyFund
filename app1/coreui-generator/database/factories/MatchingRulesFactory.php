<?php

namespace Database\Factories;

use App\Models\MatchingRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchingRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchingRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'dollar_range_start' => $this->faker->word,
        'dollar_range_end' => $this->faker->word,
        'date_start' => $this->faker->word,
        'date_end' => $this->faker->word,
        'match_percent' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
