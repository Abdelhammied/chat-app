@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <ul class="list-group">
                @foreach ($chatrooms as $chatroom)
                <li class="list-group-item">
                    Chatroom With: <a href="/user/{{ $chatroom->fetchAnotherUser->id }}">{{ $chatroom->fetchAnotherUser->name }}</a>
                    <a href="/my-chat/{{ $chatroom->room_id }}" class="text-danger float-right">
                        Go To Chat
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection