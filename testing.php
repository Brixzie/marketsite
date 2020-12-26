<?php
    require_once 'core/init.php';
    $user = new User();
    ?>
<?php include('templates/navbar.php'); ?>
<h1>Testing methods</h1>
<?php
      
        if(isset($_POST['button1'])) { 
            $user->simpleMessage();
        } 
        if(isset($_POST['button2'])) { 
            $user->testUserSessionInsert();
        }
        if(isset($_POST['button3'])) { 
            $user->testUserInsert();
        } 
    ?> 
<form method="post"> 
        <input type="submit" name="button1" value="Simple Message"/>
        <input type="submit" name="button2" value="Create User Session"/> 
        <input type="submit" name="button3" value="Create user"/> 
</form> 