<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'inventories' => $this->faker->numberBetween(10,100),
            'price' => $this->faker->numberBetween(5,20),
            'total_sales' => $this->faker->numberBetween(0,0),
        ];
    }
}
