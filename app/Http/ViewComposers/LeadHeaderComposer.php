<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Lead\LeadRepositoryContract;

class LeadHeaderComposer
{
    /**
     * The task repository implementation.
     *
     * @var taskRepository
     */
    protected $lead;

    /**
     * Create a new profile composer.
     * LeadHeaderComposer constructor.
     * @param LeadRepositoryContract $lead
     */
    public function __construct(LeadRepositoryContract $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // print_r("error 2!");
        //print_r($lead);

        // $lead = $this->lead->find($view->getData()['lead']['id']);
        // print_r("error 3!");
        /**
         * [User assigned the task]
         * @var contact
         */
       
        // $contact = $lead->user;
        // $client = $lead->client;
        
        // $view->with('contact', $contact);
        // $view->with('client', $client);
    }
}
