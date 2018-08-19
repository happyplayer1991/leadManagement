<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\LeadAction' => [
            'App\Listeners\LeadActionNotify',
            'App\Listeners\LeadActionLog',
        ],
        'App\Events\ActivitiesAction' => [
            'App\Listeners\ActivitiesActionNotify',
            'App\Listeners\ActivitiesActionLog',
        ],
        'App\Events\ProductAction' => [
            'App\Listeners\ProductActionNotify',
            'App\Listeners\ProductActionLog',
        ],
        'App\Events\QuotationAction' => [
            'App\Listeners\QuotationActionNotify',
            'App\Listeners\QuotationActionLog',
        ],
        'App\Events\TaxsAction' => [
            'App\Listeners\TaxsActionNotify',
            'App\Listeners\TaxsActionLog',
        ],
        'App\Events\ClientAction' => [
            'App\Listeners\ClientActionNotify',
            'App\Listeners\ClientActionLog',
        ],
         'App\Events\TaskAction' => [
            'App\Listeners\TaskActionNotify',
            'App\Listeners\TaskActionLog',
         ],
         'App\Events\UserAction' => [
            'App\Listeners\UserActionNotify',
            'App\Listeners\UserActionLog',
         ],
    ];

    /**
     * Register any other events for your application.
     *
     * @internal param DispatcherContract $events
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
