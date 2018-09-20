<?php

namespace App\Events;

use App\Model\Orders\OrderHistory;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderHistoryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order_history;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OrderHistory $order_history)
    {
        $this->order_history = $order_history;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
