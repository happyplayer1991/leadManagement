<?php

namespace App\Listeners;

use App\Events\UserAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\User;


class UserActionLog
{
    // print_r('manisha');exit;
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
        switch ($event->getAction()) {
            case 'manager':
                $text = __('lead Role was changed as Manager by admin', [
                    'lead' => $event->getUser()->name,
                    'admin' => Auth()->user()->name
                ]);
                break;
            case 'employee':
                $text =  __('lead Role was changed as Employee by admin', [
                    'lead' => $event->getUser()->name,
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
                 'source_type' => User::class,
                 'source_id' =>  $event->getUser()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
