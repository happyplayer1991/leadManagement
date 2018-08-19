<?php

namespace App\Listeners;

use App\Events\QuotationAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Quotation;


class QuotationActionLog
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
    public function handle(QuotationAction $event)
    {
        switch ($event->getAction()) {
            case 'submit':
                $text = __('Quotation was added by admin', [
                    'admin' => Auth()->user()->name
                ]);
            default:
                break;
        }

         $activityinput = array_merge(
             [
                 'text' => $text,
                 'user_id' => Auth()->id(),
                 'source_type' => Quotation::class,
                 'source_id' =>  $event->getQuotation()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
