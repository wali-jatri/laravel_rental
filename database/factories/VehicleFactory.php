<?php
namespace Database\Factories;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
class VehicleFactory extends Factory{
    public function definition(){
        return [
            'model' => $this->faker->name(),
            'partner_id' => Partner::inRandomOrder()->first()->id,
            'license_plate' => $this->faker->randomNumber(9),
        ];
    }
}
