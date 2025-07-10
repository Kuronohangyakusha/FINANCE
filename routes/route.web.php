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
        'liste' => ['controller' => CompteController::class, 'action' => 'store', 'middleware' => 'auth'],
        'logout' => ['controller' => SecurityController::class, 'action' => 'logout'],
    ];

