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
    public function user_can_register(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('users', ['email' => $userData['email']]);
    }

    /** @test */
    public function user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        $credentials = [
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_can_logout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/logout');

        $response->assertRedirect('/');
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
