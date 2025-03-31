<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class UserRegistrationTest extends TestCase
{
    use WithFaker;
    // ? vendor/bin/phpunit tests/Feature
    
    public function test_user_registration_with_valid_data()
    {
        $requestData = [
            'first_name' => $this->faker->name(),
            'telephone_no_1' => $this->faker->numerify('07########'),
            'email' => $this->faker->unique()->email(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->json('POST', '/api/auth/register', $requestData);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'user', 'status']);
        $this->assertDatabaseHas('users', ['email' => $requestData['email']]);
    }


    public function test_user_registration_with_missing_required_fields()
    {

        $requestData = [
            'last_name' => $this->faker->lastName,
            'town' => $this->faker->city,
            'district' => $this->faker->state,
            'telephone_no_1' => $this->faker->numerify('07########'),
            'telephone_no_2' => $this->faker->numerify('07########'),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        $response = $this->json('POST', '/api/auth/register', $requestData);

        
        $response->dump(); 
        // dd($response->decodeResponseJson()); 
        $response->assertStatus(400);
    }


    public function test_user_registration_with_invalid_email_format()
    {
        $requestData = [
            'first_name' => $this->faker->name(),
            'telephone_no_1' => $this->faker->numerify('07########'),
            'email' => 'invalid-email',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->json('POST', '/api/auth/register', $requestData);

        $response->assertStatus(400);
        $response->dump();
    }


    public function test_user_registration_with_non_matching_password_confirmation()
    {
        $requestData = [
            'first_name' => $this->faker->name(),
            'telephone_no_1' => $this->faker->numerify('07########'),
            'email' => $this->faker->unique()->email(),
            'password' => 'password123',
            'password_confirmation' => 'password124',
        ];

        $response = $this->json('POST', '/api/auth/register', $requestData);

        $response->assertStatus(400);
        $response->dump();
    }


    public function test_user_registration_with_duplicate_email()
    {
        $user = User::factory()->create([
            'first_name' => $this->faker->name(),
            'email' => 'duplicate@example.com',
        ]);

        $requestData = [
            'first_name' => $this->faker->name(),
            'telephone_no_1' => $this->faker->numerify('07########'),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'email' => 'duplicate@example.com',
        ];

        $response = $this->json('POST', '/api/auth/register', $requestData);

        $response->assertStatus(400);
        $response->dump();
    }


    public function test_user_registration_with_invalid_telephone_number()
    {
        $requestData = [
            'first_name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'telephone_no_1' => 'invalid-number',
        ];

        $response = $this->json('POST', '/api/auth/register', $requestData);

        $response->assertStatus(400);
        $response->dump();
    }
}
