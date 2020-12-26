<?php
    require_once 'core/init.php';
    $user = new User();
?>

<html>
        <div class="topnav">
        <a class="active" href="http://localhost/rymla3/index.php">Index</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <a href="testing.php">Testing</a>
        <?php
        if($user->isLoggedIn()){
                ?>
                <a href="searchlist.php">Search listings</a>
                <a href="postlist.php">Post listing</a>
                <?php
        }?>
        


        </div>
</html>