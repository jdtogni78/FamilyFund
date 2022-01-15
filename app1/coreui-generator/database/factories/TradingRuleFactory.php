<?php

namespace Database\Factories;

use App\Models\TradingRule;
use Illuminate\Database\Eloquent\Factories\Factory;

class TradingRuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TradingRule::class;

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
        //'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        //'created_at' => $this->faker->date('Y-m-d H:i:s'),
        //'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
