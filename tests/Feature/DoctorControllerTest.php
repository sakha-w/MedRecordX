<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DoctorControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_index_view_with_doctors()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Arrange: Create some doctors
        $doctors = Doctor::factory()->count(3)->create();

        // Act: Make a GET request to the index route
        $response = $this->get(route('dokter.index'));

        // Assert: Check that the response is OK
        $response->assertStatus(200);

        // Assert: Check that the correct view is returned
        $response->assertViewIs('doctors.index');

        // Assert: Check that the view has the correct data
        $response->assertViewHas('pageTitle', 'Data Dokter');
        $response->assertViewHas('doctors', function ($viewDoctors) use ($doctors) {
            return $viewDoctors->count() === $doctors->count();
        });
    }
}
