<?php

namespace Database\Factories;

use App\Models\AccountGoal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountGoalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccountGoal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        //     'account_id' => $this->faker->word,
        // 'goal_id' => $this->faker->word,
        // 'created_at' => $this->faker->date('Y-m-d H:i:s'),
        // 'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        // 'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
