<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'room_id',
        'user_1_id',
        'user_2_id'
    ];

    public function chatroom_first_user()
    {
        return $this->belongsTo(\App\User::class, 'user_1_id');
    }

    public function chatroom_second_user()
    {
        return $this->belongsTo(\App\User::class, 'user_2_id');
    }

    public function hasThisUser($user_id)
    {
        return $this->user_1_id === $user_id || $this->user_2_id === $user_id;
    }

    public function fetchAnotherUser()
    {
        return (auth()->user()->id === $this->chatroom_first_user->id)  ? $this->chatroom_second_user() : $this->chatroom_first_user();
    }

    public function chatRoomMessages()
    {
        return $this->hasMany(\App\Messages::class, 'chat_room_id');
    }

    public function addNewMessage($new_message)
    {
        return $this->chatRoomMessages()->create([
            'message' => $new_message,
            'sent_by' => auth()->user()->id,
        ]);
    }
}
