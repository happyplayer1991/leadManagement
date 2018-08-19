<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Quotation;


class QuotationAction
{
    private $quotation;
    private $action;

    use InteractsWithSockets, SerializesModels;

    public function getQuotation()
    {
        return $this->quotation;
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
    public function __construct(Quotation $quotation, $action)
    {
        $this->quotation = $quotation;
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
