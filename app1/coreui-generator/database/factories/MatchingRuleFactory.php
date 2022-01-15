<?php

namespace Database\Factories;

use App\Models\MatchingRule;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchingRuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MatchingRule::class;

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
        //'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        //'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
