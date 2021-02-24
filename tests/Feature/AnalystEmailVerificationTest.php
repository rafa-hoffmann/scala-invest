<?php

namespace Tests\Feature;

use App\Models\Analyst;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class AnalystEmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered()
    {
        $analyst = Analyst::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($analyst, 'analyst')->get('analyst/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified()
    {
        Event::fake();

        $analyst = Analyst::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'analyst.verification.verify',
            now()->addMinutes(60),
            ['id' => $analyst->id, 'hash' => sha1($analyst->email)]
        );

        $response = $this->actingAs($analyst, 'analyst')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($analyst->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('analyst.dashboard').'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash()
    {
        $analyst = Analyst::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'analyst.verification.verify',
            now()->addMinutes(60),
            ['id' => $analyst->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($analyst, 'analyst')->get($verificationUrl);

        $this->assertFalse($analyst->fresh()->hasVerifiedEmail());
    }
}
