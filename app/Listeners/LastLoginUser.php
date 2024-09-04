<?php

namespace App\Listeners;

use App\Events\Login;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class LastLoginUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user_id = $event->user->id;
        $user = User::findorFail($user_id);
        $user->last_login = Carbon::now();
        $user->save();
        // dd('event worked');
    }
}
