<?php
    require_once 'core/init.php';
?>

<?php include('templates/navbar.php'); ?>


    <?php


//Helps flash if there exists a sessions 
//(shows a message such as "Registered" only once)    
if(Session::exists('home')){
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User(); //Current user
#echo $user->data()->username;
?>

	<!-- Image Carousel -->
<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="">

        <!-- Carousel Content -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/blueBG.jpeg" alt="" class="w-100">
                <div class="carousel-caption">
                    <div class="containerMid">
                        <div class="row justify-content-center">
                            <div class="col-10 bg-custom d-lg-block py-3 px-0">
                                <h3>Har du orymligt lite plats?</h3>
                                <p>Låt oss connecta dig med en förvaringsvärd nära dig!</p>
                                <a href="searchList.php" class="btn btn-danger btn-lg">Sök</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
		<!-- End Carousel Content -->

		<!-- Previous & Next Buttons -->

		<!-- End Previous & Next Buttons -->

</div>
    <!-- End Image Carousel -->



<div class="container">
    <div class="row">
        <div class="col-6 col-sm-6">

            <div class="pink-paragraph">
                <h3>Förvara</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="pink-paragraph">
                <h3>Hyr ut ditt utrymme</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>




<!-- 
    <div class="page-header">
        <h1>Rymla</h1>
    </div>
    -->
    <div class="container-fluid">
            <div class="bottom-part">
            <div class="row">
                <div class="col-10 col-sm-8 col-md-6 col-lg-6 col-xl-3">
                    <div class="bottom-paragraph">
                        <h5>
                        <?php
                        if($user->isLoggedIn()){?>
                            Hej <?php echo ($user->data()->username); ?>, kontakta oss här!
                        <?php

                        }else{
                            ?>Kontakta oss</h5><?php
                        }
                        ?>
                        
                        <hr class="bottomDivider">
                        <p>Rymla&trade; AB<br>
                        Telefon: +46 76 222 444 666<br>
                        e-post: info@rymla.se<br>
                        Address: GREVGATAN 39, 114 53 Stockholm
                        </p>
                    </div>
                </div>
                <!--
        <div class="col-sm">
            <div class="bottom-paragraph">
                <h3>Hyr ut ditt utrymme</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
        </div>
-->
            </div>
                  
        </div>
    </div>






    <!--
        <div class="container">
            <div class="title">
                <h4 class="text-dark pt-4">Förvaring För Alla Behov</h4>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="card">
                    <img src="images/1.jpg" class="img-responsive">
                        
                    </div>
    
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="card text-center">
                        <img src="images/2.jpg" class=_card-img-top>
                       
                    </div>
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <div class="card text-center">
                        <img src="images/3.jpg" class=_card-img-top>
                
                    </div>
                </div>
            </div>
        </div>
-->
<!-- Image Carousel -->

<!--
<div id="carousel" class="carousel slide" data-ride="carousel" data-interval="">

        <!-- Carousel Content -->
        <!--
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/paket.jpg" alt="" class="w-100">
                <div class="carousel-caption">
                    <div class="container">
                    <div class="row justify-content-left">
                        <div class="col-8 bg-custom d-lg-block py-3 px-0">
                            <h3>Har du extra utrymme?</h3>
                            <p>Låt oss connecta dig med en förvaringsvärd nära dig!</p>
                            <a href="searchList.php" class="btn btn-danger btn-lg">Sök</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


<div class="container">
    <div class="page-header">
        <h1>Rymla</h1>
    </div>
    <div class="jumbotron jumbotron-fluid">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>    
    </div>
</div>



        <!--
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-12 col-lg-12">
            <img src="images/paket.jpg" class="w-100">
        </div>
        
            <div class="col-lg-12 col-md-4 col-xs-6">
            <img src="images/paket.jpg" class=img-responsive>
            </div>
    
    </div>

</div>
   

    </div>
-->
<!-- Three column section -->
<!--
    <div class="col-12 text-left mt-3">
        <h4 class="text-dark pt-4">Förvaring För Alla Behov</h3>
    </div>

<div class="container">
    <div class="row my-5">
        <div class="col-md-4 my-4">
            <img src="images/1.jpg" alt="" class="w-100">
            <h4 class="my-4">Hushållsartiklar</h4>
            <p>Har du fullt hemma eller är i behov av att förvara din saker någon annanstans?Förvara dina saker hos en av våra verifierade värdar.</p>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-md-4 my-4">
            <img src="images/2.jpg" alt="" class="w-100">
            <h4 class="my-4">Hushållsartiklar</h4>
            <p>Har du fullt hemma eller är i behov av att förvara din saker någon annanstans?Förvara dina saker hos en av våra verifierade värdar.</p>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-md-4 my-4">
            <img src="images/3.jpg" alt="" class="w-100">
            <h4 class="my-4">Hushållsartiklar</h4>
            <p>Har du fullt hemma eller är i behov av att förvara din saker någon annanstans?Förvara dina saker hos en av våra verifierade värdar.</p>
        </div>
    </div>

</div>
 -->


<!-- Background image -->
<!--
<div class="fixed-background">
    <div class="fixed-wrap">
        <div class="fixed">
            <div class="search-caption">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8 bg-custom">
                        <h3>Har du orymligt lite plats?</h3>
                        <p>Låt oss connecta dig med en förvaringsvärd nära dig!</p>
                        <a href="searchList.php" class="btn btn-danger btn-lg">Sök</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
-->

<!--
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
-->


<!--<input type="button" value="Logout" onclick="window.location.href='http://localhost/rymla3/logout.php'" />-->


