<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogLockout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Lockout  $event
     * @return void
     */
    public function handle(Lockout $event)
    {
        // dd( $event );

        $ip       = request()->ip();
        $email    = $event->request->parameteres['email'];
        $password = $event->request->parameteres['password'];

        Log::warning('Too many failed login attempts from email: ' . $email . ' using the following ip: ' . $ip . '. User has been blocked temporarly!' );
    }
}
