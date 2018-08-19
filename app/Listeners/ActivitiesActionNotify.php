<?php

namespace App\Listeners;

use App\Events\ActivitiesAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ActivitiesActionNotification;

class ActivitiesActionNotify
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
    public function handle(ActivitiesAction $event)
    {
         $activity = $event->getActivities();
         $action = $event->getAction();
         $activity->user->notify(new ActivitiesActionNotification(
             $activity,
             $action
         ));
    }
}
