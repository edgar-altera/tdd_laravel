<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->text(200)
        ];
    }
}
