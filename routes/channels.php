<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\ChatRoom;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat', function () {
    return true;
});

Broadcast::channel('room.{roomId}', function ($user, $roomId) {
    $room = ChatRoom::find($roomId);
    // Log::info($user);
    // Log::error($room);
    // if(empty(strpos((string)$room->ids,(string)$user->id))){
    //     return false;
    // }
    return true;
});

