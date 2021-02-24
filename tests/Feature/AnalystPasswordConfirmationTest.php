<?php

namespace Tests\Feature;

use App\Models\Analyst;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnalystPasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered()
    {
        $analyst = Analyst::factory()->create();

        $response = $this->actingAs($analyst, 'analyst')->get('analyst/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed()
    {
        $analyst = Analyst::factory()->create();

        $response = $this->actingAs($analyst, 'analyst')->post('analyst/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password()
    {
        $analyst = Analyst::factory()->create();

        $response = $this->actingAs($analyst, 'analyst')->post('analyst/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
