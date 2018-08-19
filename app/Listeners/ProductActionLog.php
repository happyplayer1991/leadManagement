<?php

namespace App\Listeners;

use App\Events\ProductAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Activity;
use Lang;
use App\Models\Product;


class ProductActionLog
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
        switch ($event->getAction()) {
            case 'added':
                $text = __('Product was added by admin', [
                    'admin' => Auth()->user()->name
                ]);
            default:
                break;
        }

         $activityinput = array_merge(
             [
                 'text' => $text,
                 'user_id' => Auth()->id(),
                 'source_type' => Product::class,
                 'source_id' =>  $event->getProduct()->id,
                 'action' => $event->getAction()
             ]
         );
        
         Activity::create($activityinput);
    }
}
