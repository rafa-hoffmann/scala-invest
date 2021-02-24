<?php

namespace App\Http\Controllers\Analyst\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user('analyst')->hasVerifiedEmail()
                    ? redirect()->intended(route('analyst.dashboard'))
                    : view('analyst.auth.verify-email');
    }
}
