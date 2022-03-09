<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('chat.{from_user_id}.{to_user_id}', function ($user, $from_user_id, $to_user_id) {
    //$from_user_id has to be present even if not used for all the vars in the route to be assigned correctly 
    return (int) $user->id === (int) $to_user_id;
});
