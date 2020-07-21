<?php

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

// Broadcast::channel('App.User.{id}', function ($user, $id) {
//     //return true;
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('App.User.{combine_id}', function ($user,$combine_id,$pivote = 1) {
    return true;
    return (int) $user->id === (((int) $combine_id) / ((int) $pivote)) ;
});

Broadcast::channel('{receiver_id}', function ($receiver_id) {
    return true;
    //return (int) $user->id === (((int) $combine_id) / ((int) $pivote)) ;
});

Broadcast::channel('hplink', function ($user) {
    return true;
});
