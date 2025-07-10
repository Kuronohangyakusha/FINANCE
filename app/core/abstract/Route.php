<?php
namespace App\Core\abstract;

use App\Core\Middlewares\Auth;
 
class Route{
    public static function resolve(array $routes){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');
        
        if (isset($routes[$uri])){
            $route = $routes[$uri];
            $controller = $route['controller'];
            $method = $route['action'];
            $middleware = $route['middleware'] ?? null;
            
            // Vérifier le middleware si défini
            if ($middleware && $middleware === 'auth') {
                if (!Auth::check()) {
                    redirect('/login');
                    return;
                }
            }
            
            $instance = new $controller;
            $instance->$method();
            return;
        }
        
        // Route non trouvée
        http_response_code(404);
        echo "Page non trouvée";
    }
}