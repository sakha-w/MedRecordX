<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicalRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the index route returns t~he correct view and data.
     *
     * @return void
     */
    public function test_index_displays_medical_records()
    {
        // Create and authenticate a user with the 'admin' role
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Arrange: Create some medical records
        $doctor = Doctor::factory()->create();
        $patient = Patient::factory()->create();
        $medicalRecords = MedicalRecord::factory()->count(3)->create([
            'id_pasien' => $patient->id_pasien,
            'id_dokter' => $doctor->id_dokter,
        ]);

        // Act: Make a GET request to the index route
        $response = $this->get(route('rekam_medis.index'));

        // Assert: Check that the response is OK
        $response->assertStatus(200);

        // Assert: Check that the correct view is returned
        $response->assertViewIs('medical_records.index');

        // Assert: Check that the view has the correct data
        $response->assertViewHas('pageTitle', 'Data Rekam Medis');
        $response->assertViewHas('medicalRecords', function ($viewRecords) use ($medicalRecords) {
            return $viewRecords->count() === $medicalRecords->count();
        });
    }
}
