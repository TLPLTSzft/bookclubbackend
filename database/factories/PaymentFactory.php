<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $member_ids = Member::all()->pluck('id');
        return [
            'member_id' => fake()->randomElement($member_ids),
            'amount' => fake()->numberBetween(500, 5000),
            'paid_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
