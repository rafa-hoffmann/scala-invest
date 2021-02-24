<?php

namespace Tests\Feature;

use App\Models\Analyst;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalystAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('analyst/login');

        $response->assertStatus(200);
    }

    public function test_analysts_can_authenticate_using_the_login_screen()
    {
        $analyst = Analyst::factory()->create();

        $response = $this->post('analyst/login', [
            'email' => $analyst->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated('analyst');
        $response->assertRedirect(route('analyst.dashboard'));
    }

    public function test_analysts_can_not_authenticate_with_invalid_password()
    {
        $analyst = Analyst::factory()->create();

        $this->post('analyst/login', [
            'email' => $analyst->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('analyst');
    }
}
