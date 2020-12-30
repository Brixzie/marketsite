<?php

//Native to PHP
//session_start() creates a session or resumes the 
//current one based on a session identifier passed 
//via a GET or POST request, or passed via a cookie.
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'rymladb'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

#autoloads classes we need
#$ class represents the class we're trying to access
#spl = standard php library
#classes
spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
}
);

#functions
require_once 'functions/sanitize.php';


if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('user_session', array('hash', '=', $hash));

    if($hashCheck->count()){
        #echo 'Hash matches, log user in';
        #we instantiate it with a specific user
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
    
}