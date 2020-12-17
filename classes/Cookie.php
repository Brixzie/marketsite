<?php
class Cookie{
    public static function exists($name){
        return(isset($_COOKIE[$name])) ? true : false;
    }

    public static function get($name){
        return $_COOKIE[$name];
    }

    public static function put($name, $value, $expiry){
        if(setcookie($name, $value, time() + $expiry, '/')){
            return true;
        }
        return false;
    }



    public static function delete($name){
        //Calls class own put method and replaces cookie with empty string
        self::put($name, '', time() - 1);
    }
}