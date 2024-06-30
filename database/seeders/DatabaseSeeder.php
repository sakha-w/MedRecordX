<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // \App\Models\User::factory(4)->create();
        // \App\Models\Doctor::factory(5)->create();
        // \App\Models\Nurse::factory(5)->create();
        // \App\Models\Pharmacist::factory(5)->create();
        // \App\Models\Patient::factory(55)->create();
        // \App\Models\Poly::factory(3)->create();
        // \App\Models\Medicine::factory(5)->create();
        // \App\Models\Queue::factory(1)->create();
    }
}