<?php
namespace Ciara2\Sprint2;

 
class Route{
    public static function resolve(array $tab){
   

    $uri = $_SERVER['REQUEST_URI'];
    $uri = trim($uri, '/');
     if (isset($tab[$uri])){

        $controller=$tab[$uri]['controller'];
        $methode=$tab[$uri]['action'];
        $instance = new $controller;
        $instance ->$methode();

        return;
     }  
  
}
}