<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'products_id' => 1068,
            'name' =>$this->faker->realText(12),
            'comment' => $this->faker->paragraph(),
        ];
    }
}
