<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poly>
 */
class PolyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_poli' => 'POL' . fake()->unique()->randomNumber(2, true),
            'nama_poli' => fake()->sentence(2)
        ];
    }
}
