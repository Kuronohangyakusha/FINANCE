<?php
namespace App\Core\middlewares;
 

use App\Core\abstract\Session;

class Auth {
    public static function check() {
        return Session::isLoggedIn();
    }
    
    public static function user() {
        return Session::getUser();
    }
    
    public static function login($user) {
        Session::setUser($user);
    }
    
    public static function logout() {
        Session::logout();
    }
    
    public static function guest() {
        return !self::check();
    }
}