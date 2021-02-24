<?php

namespace Tests\Feature;

use App\Models\Analyst;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AnalystPasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered()
    {
        $response = $this->get('analyst/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested()
    {
        Notification::fake();

        $analyst = Analyst::factory()->create();

        $response = $this->post('analyst/forgot-password', [
            'email' => $analyst->email,
        ]);

        Notification::assertSentTo($analyst, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered()
    {
        Notification::fake();

        $analyst = Analyst::factory()->create();

        $response = $this->post('analyst/forgot-password', [
            'email' => $analyst->email,
        ]);

        Notification::assertSentTo($analyst, ResetPassword::class, function ($notification) {
            $response = $this->get('analyst/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token()
    {
        Notification::fake();

        $analyst = Analyst::factory()->create();

        $response = $this->post('analyst/forgot-password', [
            'email' => $analyst->email,
        ]);

        Notification::assertSentTo($analyst, ResetPassword::class, function ($notification) use ($analyst) {
            $response = $this->post('analyst/reset-password', [
                'token' => $notification->token,
                'email' => $analyst->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
