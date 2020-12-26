<?php
    require_once 'core/init.php';
?>

<?php include('templates/navbar.php'); ?>


    <?php


#$testo = new User();
#echo '<br>';
#$testo->testing();

/*
    echo 'test';
    echo (Session::exists('success'));*/
#echo Session::get(Config::get('session/session_name'));

//Helps flash if there exists a sessions 
//(shows a message such as "Registered" only once)    
if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User(); //Current user



#echo $user->data()->username;
?>
<style>
body {
  

}
div {
  width: 100%;
  height: 400px;
  background-image: url('images/background.png');
  background-size: cover;
  border: 1px solid red;
}

}
</style>
<form>
<input type="button" value="Login" onclick="window.location.href='http://localhost/rymla3/login.php'" />
<input type="button" value="Logout" onclick="window.location.href='http://localhost/rymla3/logout.php'" />
</form>

<?php
if($user->isLoggedIn()){?>
    <p>Hello <?php echo escape($user->data()->userID); ?></p>
<?php
}else{
    echo "Not logged in";
}
?>