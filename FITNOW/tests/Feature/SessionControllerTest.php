<?php

namespace Tests\Feature;

use App\Models\Session;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    use RefreshDatabase;


    public function testIndex()
    {
        
        $user = User::factory()->create();

        
        $sessions = Session::factory()->count(3)->create(['user_id' => $user->id]);

     

        $response = $this->actingAs($user)->get('/api/sessions/');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'sessions',
                 ]);
    }

    public function testStore()
    {
        
        $user = User::factory()->create();

        $token = $user->createToken('TestToken')->plainTextToken;

        
        $sessionData = [
            'name' => 'Test Session',
            'weight' => 70.5,
            'chest' => 95.2,
            'waist' => 80.0,
        ];

       
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->post('/api/sessions', $sessionData);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'session created successfully',
                 ]);
    }

    public function testUpdate()
    {
    
        $user = User::factory()->create();

        
        $session = Session::factory()->create(['user_id' => $user->id]);

       
        // $token = $user->createToken('TestToken')->plainTextToken;

       
        $updatedSessionData = [
            'name' => 'Updated Session',
            'weight' => 75.0,
            'chest' => 100.0,
            'waist' => 85.0,
            'status' => 'terminer',
        ];

        $response = $this->actingAs($user)->put('/api/sessions/' . $session->id, $updatedSessionData);
        // $response = $this->withHeader('Authorization', 'Bearer ' . $token)->put('/api/sessions/' . $session->id, $updatedSessionData);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'session updated successfully',
                 ]);
    }

    public function testDestroy()
    {
        
        $user = User::factory()->create();

        
        $session = Session::factory()->create(['user_id' => $user->id]);

    
        $token = $user->createToken('TestToken')->plainTextToken;

        
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('/api/sessions/' . $session->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Session deleted successfully',
                 ]);
    }

    public function testStatus()
    {
        
        $user = User::factory()->create();

        $session = Session::factory()->create(['user_id' => $user->id]);

        $updatedSessionData = [
            
            'status' => 'non terminer',
        ];
        
        $response = $this->actingAs($user)->patch('/api/sessions/' . $session->id,$updatedSessionData );
       
        

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'the session status is updated'&&'the session has finished'
                 ]);
    }
}
