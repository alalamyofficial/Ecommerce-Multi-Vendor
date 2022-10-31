<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(50),
            'image' => $this->faker->imageUrl(640,480),
            'category' => $this->faker->sentence(5),
            'quantity' => $this->faker->randomDigitNot(5),
            'user_id' => $this->faker->randomDigitNot(5),
            'price' => $this->faker->randomNumber(2),
            'discount_price' => $this->faker->randomNumber(2)
            // 'image' => 'https://i.stack.imgur.com/5gb8N.png',

        ];
    }
}
