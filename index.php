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
                                <h3>Do you need more space?</h3>
                                <p>Let us connect you with someone who has space for rent</p>
                                <a href="searchList.php" class="btn btn-danger btn-lg">Search</a>
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
                <h3>Store</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
        </div>
        <div class="col-6 col-sm-6">
            <div class="pink-paragraph">
                <h3>Rent your extra space</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>





    <div class="container-fluid">
            <div class="bottom-part">
            <div class="row">
                <div class="col-10 col-sm-8 col-md-6 col-lg-6 col-xl-3">
                    <div class="bottom-paragraph">
                        <h5>
                        <?php
                        if($user->isLoggedIn()){?>
                            Hi <?php echo ($user->data()->username); ?>, contact us here!
                        <?php

                        }else{
                            ?>Contact us</h5><?php
                        }
                        ?>
                        
                        <hr class="bottomDivider">
                        <p>STRGMRKT&trade; LLC<br>
                        Phone: +1 305 222 444 <br>
                        e-mail: info@strgmrkt.com<br>
                        Address: NE Baystreet 115 , 33122 Miami
                        </p>
                    </div>
                </div>
     
            </div>
                  
        </div>
    </div>



