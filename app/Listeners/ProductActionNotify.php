<?php

namespace App\Listeners;

use App\Events\ProductAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\ProductActionNotification;

class ProductActionNotify
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
    public function handle(ProductAction $event)
    {
         $product = $event->getProduct();
         $action = $event->getAction();
         $product->user->notify(new ProductActionNotification(
             $product,
             $action
         ));
    }
}
