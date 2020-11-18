<?php
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
        'session_name' => 'user'
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