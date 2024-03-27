<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUserCanRegister()
    {
        $response = $this->post('/api/auth/register', [
            'name' => 'youssef',
            'email' => 'youssef12@gmail.com',
            'password' => '12345'     
        ]);

        $response->assertStatus(200);
    }
    public function testUserCanLogin()
    {
        $user = User::factory()->create([
            'email' => 'youssef@gmail.com',
            'password' => bcrypt('12345'), 
        ]);
        $response = $this->post('/api/auth/login', [
            'email' => 'youssef@gmail.com',
            'password' => '12345'     
        ]);

        $response->assertStatus(200);
    }
    public function testUserCanLogout()
{

    $user = User::factory()->create();
    $this->actingAs($user);
    $response = $this->post('/api/logout');
    $response->assertStatus(200);
  
}

}
