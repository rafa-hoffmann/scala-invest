<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalystRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('analyst/register');

        $response->assertStatus(200);
    }

    public function test_new_analysts_can_register()
    {
        $response = $this->post('analyst/register', [
            'name' => 'Test Analyst',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated('analyst');
        $response->assertRedirect(route('analyst.dashboard'));
    }
}
