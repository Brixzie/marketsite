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

            Methods:    explode()
            Params:     xxx
*/
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