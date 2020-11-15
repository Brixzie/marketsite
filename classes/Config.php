<?php

#if path is given set $config to the $GLOBALS from init.php
#break string into array with explode  
#loop through config for each element of the array that was just exploded
class Config {
    public static function get($path=null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path); #slash is included in the passed param $path
            
            foreach($path as $bit){
                if(isset($config[$bit])){
                    $config = $config[$bit];
                }
            }
            return ($config);
        }

        return false;
    }
}