<?php

namespace App\Listeners;

use App\Events\ActivitiesAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Activities;


class ActivitiesActionLog
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
        switch ($event->getAction()) {
            case 'scheduled':
                $text = __('Activity was created by admin', [
                    'admin' => Auth()->user()->name
                ]);
                break;
            case 'completed':
                $text = __('Activity was closed by admin', [
                    'admin' => Auth()->user()->name
                ]);
                break;
            default:
                break;
        }

         $activityinput = array_merge(
             [
                 'text' => $text,
                 'user_id' => Auth()->id(),
                 'source_type' => Activities::class,
                 'source_id' =>  $event->getActivities()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
