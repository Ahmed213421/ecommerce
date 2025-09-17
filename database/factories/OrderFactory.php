<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random date in 2025
        $createdAt = $this->faker->dateTimeBetween('2025-01-01', '2025-12-31');

        return [
            'name' => $this->faker->name,
            'subtotal' => $this->faker->numberBetween(100, 1000),
            'totalprice' => fn (array $attributes) => $attributes['subtotal'] + 50,
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement(['pending', 'delivered', 'cancelled']),
            'payment' => $this->faker->randomElement(['visa', 'cash']),
            'note' => $this->faker->optional()->sentence,
            'user_id' => User::factory(),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
