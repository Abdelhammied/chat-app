<?php

namespace App\Http\Controllers;

use App\ChatRoom;
use Illuminate\Http\Request;
use App\Http\Resources\Chatroom as AppChatroom;
use App\Events\NewMessageWasSent;

class ChatroomController extends Controller
{
    public function index()
    {
        $chatrooms = auth()->user()->fetchUserChatRooms();

        return view('chatroom.index', compact('chatrooms'));
    }

    public function show(ChatRoom $chatroom)
    {
        abort_unless($chatroom->hasThisUser(auth()->user()->id), 404);

        return view('chatroom.show', compact('chatroom'));
    }

    public function fetchChatRoomData(ChatRoom $chatroom_id, Request $request)
    {
        abort_unless($chatroom_id->hasThisUser(auth()->user()->id), 404);

        abort_unless($request->ajax(), 404);

        return new AppChatroom($chatroom_id);
    }

    public function sendMessage(Request $request, ChatRoom $chatroom_id)
    {
        $chatroom_id->addNewMessage($request->message);

        event(new NewMessageWasSent($request->message, $chatroom_id->id));
        
        return response()->json('success', 200);
    }
}
