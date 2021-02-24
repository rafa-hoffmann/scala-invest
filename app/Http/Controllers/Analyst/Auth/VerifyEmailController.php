<?php

namespace App\Http\Controllers\Analyst\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated analyst's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user('analyst')->hasVerifiedEmail()) {
            return redirect()->intended(route('analyst.dashboard').'?verified=1');
        }

        if ($request->user('analyst')->markEmailAsVerified()) {
            event(new Verified($request->user('analyst')));
        }

        return redirect()->intended(route('analyst.dashboard').'?verified=1');
    }
}
