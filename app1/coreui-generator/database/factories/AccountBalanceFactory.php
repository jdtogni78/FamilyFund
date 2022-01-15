<?php

namespace Database\Factories;

use App\Models\AccountBalance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountBalanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountBalance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
        'shares' => $this->faker->word,
        //'account_id' => $this->faker->word,
        //'transaction_id' => $this->faker->word,
        'start_dt' => $this->faker->word,
        'end_dt' => $this->faker->word,
        //'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        //'created_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
