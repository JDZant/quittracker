<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;


class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
/*    public function user_can_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }*/

    public function user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
        ]);

        $loginData = [
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200);
        $this->assertAuthenticated();
    }

    public function user_can_logout()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
        $this->assertGuest();
    }

    /** @test */
    /*    public function user_can_reset_password(): void
        {
            $user = User::factory()->create(['email' => 'john@example.com']);

            $response = $this->post('/password/email', ['email' => 'john@example.com']);

            $response->assertRedirect('/password/reset');
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $this->assertDatabaseHas('password_resets', [
                'email' => 'john@example.com',
                'token' => $token,
            ]);
        }*/
}
