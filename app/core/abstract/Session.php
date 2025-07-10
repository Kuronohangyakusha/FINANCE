<?php
namespace App\Core;
 
 
 


class Session{
    private static ?Session $instance = null; 

    private function __construct(){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
    }

     public static function getInstance():Session{
        if(self::$instance===null){
            self::$instance = new Session();
        }
        return self::$instance;

    }

    public static function set($key, $data){
        $_SESSION[$key] = $data;

    }

    public static function get($key){
        return $_SESSION[$key]?? null;

    }

    public static function unset($key){
        unset($_SESSION[$key]);
    }

    public static function isset($key){
        return isset($_SESSION[$key]);

    }

    public static function destroy(){
    
    public static function setUser($user) {
        $_SESSION['user'] = $user;
    }
    
    public static function getUser() {
        return $_SESSION['user'] ?? null;
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }
    
    public static function logout() {
        unset($_SESSION['user']);
    }
        session_unset();
        session_destroy();
        self::$instance = null;

    }

   
    
}