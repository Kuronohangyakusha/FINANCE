<?php
use App\Controller\SecurityController;
use App\Controller\CompteController;

 $TabUri= [
        "" => ['controller' => SecurityController::class, 'action' => 'login'],
        'login' => ['controller' => SecurityController::class, 'action' => 'login'],
        'authenticate' => ['controller' => SecurityController::class, 'action' => 'authenticate'],
        'create' => ['controller' => SecurityController::class, 'action' => 'create'],
        'register' => ['controller' => SecurityController::class, 'action' => 'store'],
        'dashboard' => ['controller' => CompteController::class, 'action' => 'create', 'middleware' => 'auth'],
        'compte/create' => ['controller' => CompteController::class, 'action' => 'create', 'middleware' => 'auth'],
        'compte/store' => ['controller' => CompteController::class, 'action' => 'store', 'middleware' => 'auth'],
        'compte/list' => ['controller' => CompteController::class, 'action' => 'index', 'middleware' => 'auth'],
        'logout' => ['controller' => SecurityController::class, 'action' => 'logout'],
    ];

