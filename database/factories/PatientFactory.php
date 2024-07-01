<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = ['pria', 'wanita'];
        return [
            'id_pasien' => 'PA' . fake()->unique()->randomNumber(3, true),
            'no_bpjs' => '000' . fake()->unique()->randomNumber(9, true),
            'nama' => fake()->name(),
            'jenis_kelamin' => $gender[mt_rand(0, 1)],
            'tgl_lahir' => fake()->date(),
            'tempat_lahir' => fake()->city(),
            'alamat' => fake()->sentence(mt_rand(3, 5)),
            'no_hp' => '08' . fake()->unique()->randomNumber(9, true),
            'berat_badan' => mt_rand(10, 100),
            'tinggi_badan' => mt_rand(120, 180)
        ];
    }
}
