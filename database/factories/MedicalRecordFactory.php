<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    protected $model = MedicalRecord::class;

    public function definition()
    {
        return [
            'id_pasien'   => Patient::factory(),
            'id_dokter'   => $this->faker->randomNumber(5),
            'id_poli'     => $this->faker->randomNumber(5),
            'sistole'     => $this->faker->numberBetween(90, 140),
            'diastole'    => $this->faker->numberBetween(60, 90),
            'gula_darah'  => $this->faker->numberBetween(70, 110),
            'alergi'      => $this->faker->word,
            'keluhan'     => $this->faker->sentence,
            'diagnosis'   => $this->faker->sentence,
            'terapi'      => $this->faker->sentence,
            'resep_obat'  => $this->faker->sentence,
            'harga'       => $this->faker->numberBetween(10000, 50000),
            'tgl_periksa' => now(),
        ];
    }
}