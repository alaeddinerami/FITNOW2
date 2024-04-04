<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegister()
    {
        $userData = [
            'name' => 'abdo ',
            'email' => 'abdo569@gmail.com',
            'password' => '123456789',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }

    public function testLogin()
    {
        
        $user = User::factory()->create([
            'email' => 'abdo7@gmail.com',
            'password' => '123456789',
        ]);

        $loginData = [
            'email' => 'abdo7@gmail.com',
            'password' => '123456789',
        ];

        $response = $this->post('/api/login', $loginData);

        $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
        ]);
    }


    public function testLogout()
    {
        
        $user = User::factory()->create();

        
        $token = $user->createToken('TestToken')->plainTextToken;

        
        $response = $this->actingAs($user)->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'logged out',
            ]);
    }

}
