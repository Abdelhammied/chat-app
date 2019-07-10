@extends('layouts.app')
@section('content')
<chat :chatroom-id="{{ $chatroom->id }}" auth-user-id="{{ auth()->user()->id }}"></chat>
@endsection