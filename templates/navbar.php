<?php
    require_once 'core/init.php';
    $user = new User();
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         
         <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        
        <title>Rymla</title>
</head>
</html>


<html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="rymla.logo_.pink_.001-e1589285503472.png" width="70" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="searchlist.php">Search</a>
            </li>
            <?php
            if(!$user->isLoggedIn()){?>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="register.php">Register</a>
                </li>

              <?php }?>
              <?php
                if($user->isLoggedIn()){ ?>
                  <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="postList.php">Post listing</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="yourListings.php">Your listings</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="logout.php">Your listings</a>
                  </li>


                <?php } ?>
  




            </ul>
            </div>

        
        </div>
        </nav>

