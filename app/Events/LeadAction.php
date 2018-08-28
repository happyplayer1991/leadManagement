<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Lead;
use Auth;

class LeadAction implements ShouldBroadcast
{
    private $lead;
    private $action;

    use InteractsWithSockets, SerializesModels;

    public function getLead()
    {
        return $this->lead;
    }
    public function getAction()
    {
        return $this->action;
    }
    /**
     * Create a new event instance.
     * LeadAction constructor.
     * @param Lead $lead
     * @param $action
     */
    public function __construct(Lead $lead, $action)
    {
        $this->lead = $lead;
        $this->action = $action;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-lead');
    }

    public function broadcastWith() {
        if (Auth()->check())
            $username = Auth()->user()->name;
        else
            $username = 'unauthorized user';
        $msg = $username.' created a new lead "'.$this->lead->name.'".';
        return [
            'company_id' => $this->lead->company_id,
            'msg' => $msg
        ];
    }
}
