<?php

namespace Database\Factories;
use App\Models\Booking;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory{
    protected $model = Booking::class;
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'pickup_location' => $this->faker->address,
            'dropoff_location' => $this->faker->address,
        ];
    }
}
