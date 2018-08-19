<?php

namespace App\Listeners;

use App\Events\TaskAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\TaskActionNotification;

class TaskActionNotify
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
    public function handle(TaskAction $event)
    {
         $task = $event->getTask();
         $action = $event->getAction();
         $task->user->notify(new TaskActionNotification(
             $task,
             $action
         ));
    }
}
