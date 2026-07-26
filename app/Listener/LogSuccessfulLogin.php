<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    public function handle(Login $event): void
    {
        // Access the authenticated user
        $user = $event->user;
        
        // Example: Log the login
       session()->put($user->projet->id);
    }
}