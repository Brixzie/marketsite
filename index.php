<?php
    require_once 'core/init.php';
/*
    echo 'test';
    echo (Session::exists('success'));*/
if(Session::exists('success')){
    echo Session::flash('success');
}







echo "<c>This is the query made from the userUpdate method</c><br>";
//This works
$userUpdate = DB::getInstance()->userUpdate('users', 3,array(
    'password' => '9123',
    'username' => 'Donald'
));



echo "<c>This is the query made from the userInsert method</c><br>";
//This works
$userInsert = DB::getInstance()->userInsert('users', array(
    'username' => 'DDonald',
    'email' => 'Dale@D.g',
    'password' => '123123'
));

/*
$userInsert = DB::getInstance()->userInsert('users', array(
    'username' => 'adf',
    'name' => 'Dale',
    'email' => 'Dale@D.g',
    'password' => '123123321'
));
*/
/*
    #3 is the id of the user
    $userUpdate = DB::getInstance()->userUpdate('users', 3,array(
        'password' => '9123',
        'username' => 'Donald'
    ));


    #Own variation
    $user = DB::getInstance()->query("SELECT * FROM users");
    $results = $user->results();
    $x=0;
    while($x<$user->count()){
        echo ($results[$x]->username);
        $x++;
    }

*/



    
/*
    $userInsert = DB::getInstance()->userInsert('users', array(
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
