<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $data;

    // public $comment;
    // public $user_id;
    // public $post_id;
    public function __construct($data)
    {
        //
        $this->data = $data;


        // dd($data['comment']);
        // $this->comment = $data['comment'];
        // $this->user_id = $data['user_id'];
        // $this->post_id = $data['post_id'];

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new channel('post.' . $this->data['user_id']),
        ];
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->data['message'],
        ];
    }
}