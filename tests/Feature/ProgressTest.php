<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Progress;
use App\Models\User;
class ProgressTest extends TestCase
{
    use RefreshDatabase;
    protected $table='tbl_user';


    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testProgressCanBeCreated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/progress/add', [
            'user_id' => $user->id,
            'weight' => 11,
            'height' => 12,
            'waist_line' => 123,
            'bicep_thickness' => 35,
            'pec_width' => 35,
            'performance' => 'RDTDUFGFCGT',
            'additional_notes' => 'jrjrjjrjr'
        ]);

        $response->assertStatus(200);
    }
    public function testProgressCanBeUpdated()
    {
        
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);
        $response = $this->put('/api/progress/update/'. $progress->id,[
            'weight' => 1,
            'height' => 12,
            'waist_line' => 123,
            'bicep_thickness' => 35,
            'pec_width' => 35,
            'performance' => 'hihi',
            'additional_notes' => 'youssef'
        ]);

        $response->assertStatus(200);
    }
    public function testProgressCanBeEdited()
    {
        
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);
        $response = $this->patch('/api/progress/update-status/'. $progress->id,[
            'status' => 'unfinish'
        ]);

        $response->assertStatus(200);
    }
    public function testProgressCanBeDeleted()
    {
        
        $progress = Progress::factory()->create();
        $this->actingAs($progress->user);
        $response = $this->delete('/api/progress/delete/'. $progress->id);

        $response->assertStatus(200);
    }


  

   
}

