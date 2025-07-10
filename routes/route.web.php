<?php
use Ciara3\Sprint3\SecurityController;
use Ciara3\Sprint3\CompteController;

 $TabUri= [
        "" => ['controller' => SecurityController::class, 'action' => 'create'],
         'login' => ['controller' => SecurityController::class, 'action' => 'login'],
         'create' => ['controller' => CompteController::class, 'action' => 'create'],
         'liste' => ['controller' =>  CompteController::class, 'action' => 'store'],
         'logout' => ['controller' => SecurityController::class, 'action' => 'logout'],
    ];

