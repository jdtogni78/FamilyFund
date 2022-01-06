<?php

namespace Database\Factories;

use App\Models\TradingRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradingRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradingRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'max_sale_increase_pcnt' => $this->faker->word,
        'min_fund_performance_pcnt' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
