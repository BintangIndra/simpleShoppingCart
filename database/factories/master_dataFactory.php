<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\master_data>
 */
class master_dataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => 'FA'.$this->faker->randomNumber(4, true),
            'nama' => $this->faker->name(),
            'harga' => $this->faker->randomNumber(5, true),
        ];
    }
}
