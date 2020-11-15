<?php
    require_once 'core/init.php';


    $user = DB::getInstance()->query("SELECT * FROM users");
    
    
    //$user ->get('users', array('name', '=', 'Dorcy'));
    
    if(!$user->count()){
        echo 'No users';
    }else{
            echo $user->first()->email;
    }
    


/*
    if(!$user->count()){
        echo 'No users';
    }else{
        foreach($user->results() as $user){
            echo $user->name, '<br>';
        }
    }*/
