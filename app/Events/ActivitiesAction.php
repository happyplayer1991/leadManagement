<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Activities;

class ActivitiesAction
{
    private $activity;
    private $action;

    use InteractsWithSockets, SerializesModels;

    public function getActivities()
    {
        return $this->activity;
    }
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Create a new event instance.
     * ClientAction constructor.
     * @param Client $client
     * @param $action
     */
    public function __construct(Activities $activity, $action)
    {
        $this->activity = $activity;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
