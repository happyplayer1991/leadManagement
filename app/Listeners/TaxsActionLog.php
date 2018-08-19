<?php

namespace App\Listeners;

use App\Events\TaxsAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Taxs;


class TaxsActionLog
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
    public function handle(TaxsAction $event)
    {
        switch ($event->getAction()) {
            case 'created':
                $text = __('Tax was created by admin', [
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
                 'source_type' => Taxs::class,
                 'source_id' =>  $event->getTaxs()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
