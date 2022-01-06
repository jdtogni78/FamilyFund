<?php

namespace Database\Factories;

use App\Models\Assets;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assets::class;

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
        'source_feed' => $this->faker->word,
        'feed_id' => $this->faker->word,
        'last_price' => $this->faker->word,
        'last_price_date' => $this->faker->word,
        'deactivated' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
