<?php
 

require_once __DIR__ . '/../vendor/autoload.php';

use Ciara2\Sprint2\Route;
use Ciara3\Sprint3\CompteController;  

require_once __DIR__ . '/../routes/route.web.php';

var_dump(Route::resolve($TabUri));
Route::resolve($TabUri);
