<?php

namespace Tests\Feature;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReceptionistControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_index_view_with_nurses()
    {
        // Create and authenticate a user with the 'admin' role
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        // Arrange: Create some nurses
        $perawat = Nurse::factory()->count(3)->create();

        // Act: Make a GET request to the index route
        $response = $this->get(route('perawat.index'));

        // Assert: Check that the response is OK
        $response->assertStatus(200);

        // Assert: Check that the correct view is returned
        $response->assertViewIs('nurses.index');

        // Assert: Check that the view has the correct data
        $response->assertViewHas('pageTitle', 'Data Perawat');
        $response->assertViewHas('nurses', function ($viewNurses) use ($perawat) {
            return $viewNurses->count() === $perawat->count();
        });
    }
}
