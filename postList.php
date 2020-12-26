<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>

<?php
    $test = new User();
    if($test->isLoggedIn() ){
        if(Input::exists() && Token::check(Input::get('token'))){
            $test->testSpaceInsert();
        }
    ?>
    <body>
        <br>

        <p>A listing contains ID, user ID, name, location, space, price, time</p>

        <form action="" method="post">
  
        <div class= "field">
            <label for="password">Choose a password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class= "field">
            <label for="password_again">Repeat password</label>
            <input type="password" name="password_again" id="password_again">
        </div>

        <div class="field">
            <label for="email">Enter your email</label>
            <input type="text" name="email" value="" id="email">
        </div>
        <!-- Token is unique to this page -->
        <input type = "hidden" name = "token" value ="<?php echo Token::generate(); ?>">
        <input type = "submit" value = "Register"> 

    </form>
    </body>
<?php
}else{
    echo "Log in to post listing";
}




/*

        
    <p>Hello <?php echo escape($user->data()->userID); ?></p>
    <?php

        #echo "I am allowed to run";
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'objName' => array(
                'required' => true,
                'min' => 2,
                'max' => 20,
            ),
            'sqm' => array(
                'required' => true,
                'min' => 1,
                'max' => 10000
            ),
            'images' => array(
                'required' => false,
            ),
            'price' => array(
                'required' => true,
                'min' => 2,
                'max' => 1000000
            ),
            'dateAvail' => array(
                'required' => true,
            )
        ));

        if($validate->passed()){
            echo "Passed";
        }*/

        ?>