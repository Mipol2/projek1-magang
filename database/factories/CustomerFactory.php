<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'customer_id' => $this->faker->randomNumber(4),
            'address' => $this->faker->address,
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}