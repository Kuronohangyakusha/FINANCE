<?php
use App\Core\Middlewares\Auth;

// Configuration des middlewares
$middlewares = [
    'auth' => Auth::class,
];

return $middlewares;