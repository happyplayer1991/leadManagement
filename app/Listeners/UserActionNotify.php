<?php

namespace App\Listeners;

use App\Events\UserAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\UserActionNotification;

class UserActionNotify
{
    /**
     * Action the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LeadAction  $event
     * @return void
     */
    public function handle(UserAction $event)
    {

         $user = $event->getUser();
         $action = $event->getAction();
         $user->user->notify(new UserActionNotification(
             $user,
             $action
         ));
    }
}
