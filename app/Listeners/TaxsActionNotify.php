<?php

namespace App\Listeners;

use App\Events\TaxsAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TaxsActionNotification;

class TaxsActionNotify
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
         $tax = $event->getTaxs();
         $action = $event->getAction();
         $tax->user->notify(new TaxsActionNotification(
             $tax,
             $action
         ));
    }
}
