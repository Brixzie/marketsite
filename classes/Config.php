<?php
/*
General purpose of class:
    Holds a method that acts as a getter for the globals inside DB.php
    Abstracts access to the DB.php. Is it a Database wrapper? 
    Doesn't need to be required anywhere since we have the autoloader.
*/

#if path is given set $config to the $GLOBALS from init.php
#break string into array with explode  
#loop through config for each element of the array that was just exploded



class Config {

/*
Name:       get()
Purpose:    xxx
How:        $path set to null so that we can check if the path exists
            $config = $GLOBALS['config']; set config to array that exists inside $GLOBALS['config] from inside init.php
            $path = explode('/', $path); splits the string being passed from the __construct inside DB.php 
            loop through each of these splits, check if it exists and set 
            Methods:    explode()
            Params:     xxx
*/
    public static function get($path=null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path); #slash is included in the passed param $path
            
            #print_r($path) = Array ([0]=>mysql[1]=>host)
            foreach($path as $bit){ #as means replace digit with 
                if(isset($config[$bit])){#first loop: check if 'mysql' exists within config, second loop, check if host exists within config
                    $config = $config[$bit];#if it does we're setting config to mysql
                }
            }
            return ($config);
        }

        return false;
    }
}