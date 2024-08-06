<?php
namespace App\utils;
use Exception;

class Validator{
  public static function validateEmail(string $email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      throw new \Exception("Invalid Email");
    }  
  }
  public static function validateStringSize(string $string, int $minSize, int $maxSize){
    if(strlen($string) > $maxSize || strlen($string) < $minSize){
      throw new \Exception("Invalid string size");
    }
    
  }

}
