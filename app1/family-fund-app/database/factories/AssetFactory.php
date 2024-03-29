<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word . "_" . $this->faker->randomNumber(5),
            'type' => $this->faker->word,
            'source' => $this->faker->word,
            'display_group' => $this->faker->word,
//        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
//        'created_at' => $this->faker->date('Y-m-d H:i:s'),
//        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
