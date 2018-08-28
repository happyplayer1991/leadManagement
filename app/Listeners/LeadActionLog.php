<?php

namespace App\Listeners;

use App\Events\LeadAction;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Lead;


class LeadActionLog
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
    public function handle(LeadAction $event)
    {
        switch ($event->getAction()) {
            case 'created':
                $text = __('lead was created by admin', [
                    'lead' => $event->getLead()->name,
                    'admin' => Auth()->check() ? Auth()->user()->name : 'unauthorized user'
                ]);
                break;
            case 'updated':
                $text =  __('lead was Updated by admin', [
                    'lead' => $event->getLead()->name,
                    'admin' => Auth()->user()->name
                ]);
                break;
            case 'dropped':
                $text =  __('lead was Dropped by admin', [
                    'lead' => $event->getLead()->name,
                    'admin' => Auth()->user()->name
                ]);
                break;
            default:
                break;
        }

         $activityinput = array_merge(
             [
                 'text' => $text,
                 'user_id' => $event->getLead()->user_id,
                 'source_type' => Lead::class,
                 'source_id' =>  $event->getLead()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
