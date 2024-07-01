<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nurse>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_perawat' => 'P-' . fake()->unique()->randomNumber(3, true),
            // 'id_user' => fake()->unique()->randomDigit(),
            'nama' => fake()->name(),
            'email' => fake()->safeEmail(),
            'jenis_kelamin' => 'pria',
            'no_hp' => '08' . fake()->unique()->randomNumber(9, true),
            'alamat' => fake()->sentence(),
            'tgl_lahir' => fake()->date(),
            'tempat_lahir' => 'Metro',
        ];
    }
}
