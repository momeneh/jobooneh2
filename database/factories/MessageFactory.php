<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => Admin::all(['id'])->random(),
            'sender_type' => Admin::class,
            'receiver_id' =>User::all(['id'])->random(),
            'receiver_type' => User::class,
            'subject' => $this->faker->realText(20),
            'body' => $this->faker->paragraph(),
            'lang_id' => 1,
        ];
    }
}
