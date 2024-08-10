<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// Broadcast::channel('chat', function ($data) {
//     return true;
// });

Broadcast::channel('chat', function ( ) {
    return true;
});

// Broadcast::channel('chatCompany', function ($data) {
//     return true;
//     ;
// });
