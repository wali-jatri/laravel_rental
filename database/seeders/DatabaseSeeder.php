<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\DriverFactory;
use Database\Factories\VehicleFactory;
use Illuminate\Database\Seeder;
use App\Models\BookingRequest;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

//        BookingRequest::factory()->count(10)->create();

        DriverFactory::times(10)->create();
        VehicleFactory::times(10)->create();
    }
}
