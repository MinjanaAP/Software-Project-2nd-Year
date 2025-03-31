<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserLoginTest extends TestCase
{
    use  WithFaker;

    //? vendor/bin/phpunit tests/Unit

    public function test_user_login_with_valid_credentials()
    {
        $password = 'password123';
        $user = User::factory()->create([
            'email' => 'validuser@example.com',
            'password' => bcrypt($password),
        ]);

        $requestData = [
            'email' => $user->email,
            'password' => $password,
        ];

        $response = $this->json('POST', '/api/auth/login', $requestData);

        $response->dump(); 
        $response->assertStatus(200);
        // $response->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'user']);
    }

    public function test_user_login_with_invalid_email()
    {
        $requestData = [
            'email' => 'invaliduser@example.com',
            'password' => 'password123',
        ];

        $response = $this->json('POST', '/api/auth/login', $requestData);

        $response->dump(); // Dump the response for debugging

        $response->assertStatus(401);
        $this->assertArrayHasKey('error', json_decode($response->getContent(), true));
    }

    
    public function test_user_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'email' => 'validuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        $requestData = [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ];

        $response = $this->json('POST', '/api/auth/login', $requestData);

        $response->dump(); 

        $response->assertStatus(401);
        $this->assertArrayHasKey('error', json_decode($response->getContent(), true));
    }

    
    public function test_user_login_with_missing_required_fields()
    {
        $requestData = [
            'email' => '',
            'password' => '',
        ];

        $response = $this->json('POST', '/api/auth/login', $requestData);

        $response->dump(); 

        $response->assertStatus(422);
    }


    public function test_user_login_with_email_and_password_exceeding_max_length()
    {
        $requestData = [
            'email' => str_repeat('a', 51) . '@example.com',
            'password' => str_repeat('a', 51),
        ];

        $response = $this->json('POST', '/api/auth/login', $requestData);

        $response->dump(); 

        $response->assertStatus(422);

    }
}
