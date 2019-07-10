<?php

namespace App\Http\Resources;

use App\Http\Resources\Messages;
use Illuminate\Http\Resources\Json\JsonResource;

class Chatroom extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'chat_room_id' => $this->room_id,
            'first_user' => $this->user_1_id,
            'second_user' => $this->user_2_id,
            'chat_room_messages' => Messages::collection($this->chatRoomMessages)
        ];
    }
}
