<?php

namespace Tests\Feature;

use App\Models\Doctor;
use App\Models\Poly;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PolyControllerTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_can_store_a_new_poly()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get(route('poli.index'));

        $polyData = [
            'id_poli' => 'POL01',
            'nama_poli' => 'Poli Umum',
            '_token' => csrf_token(),
        ];

        $response = $this->post(route('poli.store'), $polyData);

        $response->assertRedirect(route('poli.index'));

        $this->assertDatabaseHas('polies', ['id_poli' => 'POL01', 'nama_poli' => 'Poli Umum']);
    }

}