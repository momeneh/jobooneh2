<?php

namespace Database\Factories;

use App\Models\Categories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(20),
            'description' => $this->faker->paragraph(),
            'confirmed' => 1,
            'sell_status' => rand(1,2),
            'price' =>  $this->faker->numberBetween(5000,1000000),
            'lang_id' => rand(1,2),
            'categories_id' => Categories::all(['id'])->random(),
            'user_id' => User::all(['id'])->random(),
            'visited_count' => rand(0,1000)
        ];
    }
}
