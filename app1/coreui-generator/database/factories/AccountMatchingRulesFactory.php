<?php

namespace Database\Factories;

use App\Models\AccountMatchingRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountMatchingRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountMatchingRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => $this->faker->randomDigitNotNull,
        'matching_id' => $this->faker->randomDigitNotNull,
        'created' => $this->faker->date('Y-m-d H:i:s'),
        'updated' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
