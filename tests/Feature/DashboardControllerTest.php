<?php

namespace Tests\Unit\Controllers;

use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method of DashboardController.
     *
     * @return void
     */
    /** @test */
    public function testIndex()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $poly = Poly::factory()->create();
        $patient = Patient::factory()->create();
        Queue::factory()->create(['id_poli' => $poly->id_poli, 'id_pasien' => $patient->id_pasien]);

        $response = $this->actingAs($admin)->get(route('dashboard.index'));

        $response->assertStatus(200);
        $response->assertViewIs('dashboard.index');
        $response->assertViewHas('pageTitle', 'Dashboard');
        $response->assertViewHas('patientCount', Patient::count());
        $response->assertViewHas('doctorCount', Doctor::count());
        $response->assertViewHas('nurseCount', Nurse::count());
        $response->assertViewHas('queueCount', Queue::where('status', 0)->count());
        // $response->assertViewHas('polyCount', Poly::count());
    }
}