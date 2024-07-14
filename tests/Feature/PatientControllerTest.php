<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Patient;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_index_view_with_patients()
    {
        // Create and authenticate a user with the 'admin' role
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Arrange: Create some patients
        $patients = Patient::factory()->count(3)->create();

        // Act: Make a GET request to the index route
        $response = $this->get(route('pasien.index'));

        // Assert: Check that the response is OK
        $response->assertStatus(200);

        // Assert: Check that the correct view is returned
        $response->assertViewIs('patients.index');

        // Assert: Check that the view has the correct data
        $response->assertViewHas('pageTitle', 'Data Pasien');
        $response->assertViewHas('patients', function ($viewPatients) use ($patients) {
            return $viewPatients->count() === $patients->count();
        });
    }
}
