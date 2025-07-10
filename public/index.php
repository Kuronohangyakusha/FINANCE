<?php
 

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/config/bootstrap.php';

use  App\Core\abstract\Route;

require_once __DIR__ . '/../routes/route.web.php';

Route::resolve($TabUri);
