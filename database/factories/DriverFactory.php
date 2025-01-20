<?php
namespace Database\Factories;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
class DriverFactory extends Factory{
    public function definition(){
        return [
            'name' => $this->faker->name(),
            'partner_id' => Partner::inRandomOrder()->first()->id,
            'license_number' => $this->faker->randomNumber(9),
        ];
    }
}
