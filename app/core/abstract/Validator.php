<?php 
namespace Ciara2\Sprint2\u\sprint\app\core\abstract;


class Validator{

 private static array $error =[];

  public static function isEmail($email){
    if(!is_string($email)){
      return false;

    }
    return filter_var($email, FILTER_VALIDATE_EMAIL)!==false;
    
  }
   public static function isEmpty($val){
      return empty($val);
   }
   public static function getError(){
      return self::$error;
   }

   public static function isValid($value){
    return empty(self::$error);
   }

   public static function addError(string $key, string $message){
      self::$error[$key] = $message;
   } 

   public static function resetError(){
      self::$error = [];
   }

}