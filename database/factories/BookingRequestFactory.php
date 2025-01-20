<?php

namespace Database\Factories;
use App\Models\BookingRequest;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingRequestFactory extends Factory{
    protected $model = BookingRequest::class;
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'pickup_location' => $this->faker->address,
            'dropoff_location' => $this->faker->address,
        ];
    }
}
