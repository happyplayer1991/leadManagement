<?php

namespace App\Listeners;

use App\Events\QuotationAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\QuotationActionNotification;

class QuotationActionNotify
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
         $quotation = $event->getQuotation();
         $action = $event->getAction();
         $quotation->user->notify(new QuotationActionNotification(
             $quotation,
             $action
         ));
    }
}
