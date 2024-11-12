<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('jobs', function ($user) {
    return true; // Aquí puedes agregar tu lógica de autorización
});
Broadcast::channel('jobs-channel', function () {
    return true; // O una lógica de autorización según sea necesario
});
