<?php
    require_once 'core/init.php';


    $userUpdate = DB::getInstance()->update('users', 3,array(
        'psw' => '9123',
        'name' => 'Donald'
    ));


/*
    $userInsert = DB::getInstance()->insert('users', array(
        'name' => 'Dale',
        'email' => 'Dale@D.g',
        'psw' => '123'
    ));
*/



 /*
    $user = DB::getInstance()->query("SELECT * FROM users");
    
    
    //$user ->get('users', array('name', '=', 'Dorcy'));
    
    if(!$user->count()){
        echo 'No users';
    }else{
            echo $user->first()->email;
    }
    */


/*
    if(!$user->count()){
        echo 'No users';
    }else{
        foreach($user->results() as $user){
            echo $user->name, '<br>';
        }
    }*/
