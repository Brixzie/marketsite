<?php
    require_once 'core/init.php';
    $user = new User();
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <!-- "make the content render at the width of the device." -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         
        <link rel="shortcut icon" href="images/logo2.ico">
        <!-- Bootstrap 4.5 CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Google Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">-->
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <title>Rymla</title>
</head>
</html>


<html>

<body>

<!-- Topbar -->
<!--
<div class="top-bar">
  <div class="container">
    <div class="col12 text-right">
      <p><a href="tel:+4688855533">Ring oss på</a></p>
    </div>
  </div>
</div>
-->
<!-- Navbar -->
<nav class="navbar bg-light navbar-light navbar-expand-md">
		<div class="container">

			<a href="index.php" class="navbar-brand"><img src="images/logo.png" alt="Logo" title="Logo"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<!--<li class="nav-item"><a href="index.php" class="nav-link">Start</a></li>-->
					<li class="nav-item"><a href="searchlist.php" class="nav-link">Sök utrymme</a></li>
          <?php
                if(!$user->isLoggedIn()){?>
                <li class="nav-item"><a href="login.php" class="nav-link">Logga in</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Registrera Dig</a></li>
          <?php }?>
          <?php
                if($user->isLoggedIn()){ ?>

                <li class="nav-item"><a href="postList.php" class="nav-link">Annonsera utrymme</a></li>
                <!--<li class="nav-item"><a href="yourListings.php" class="nav-link">Dina utrymmen</a></li>-->
                <li class="nav-item"><a href="profile.php" class="nav-link">Profil</a></li>
                <li class="nav-item"><a href="profile.php" class="nav-link">Meddelanden</a></li>
                  
          <?php }?>

					<li class="nav-item"><a href="about.php" class="nav-link">Om oss</a></li>
				</ul>
			</div>
		</div>
	</nav>


  <!-- Script Source Files -->

	<!-- jQuery -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap 4.5 JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Font Awesome -->
	<script src="js/all.min.js"></script>

	<!-- End Script Source Files -->
</body>



