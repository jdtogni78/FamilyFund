<?php

namespace Database\Factories;

use App\Models\AccountBalances;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountBalancesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountBalances::class;

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
        'account_id' => $this->faker->randomDigitNotNull,
        'tran_id' => $this->faker->randomDigitNotNull,
        'start_dt' => $this->faker->word,
        'end_dt' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
