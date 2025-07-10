<?php
// Chargement des configurations
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/helpers.php';

// Démarrage de la session
use App\Core\Session;
Session::getInstance();

// Configuration des erreurs
error_reporting(E_ALL);
ini_set('display_errors', 1);