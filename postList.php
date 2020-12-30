<?php
    require_once 'core/init.php';
    include('templates/navbar.php');
?>

<?php
    $test = new User();

    #Implement verification
    #Can I implement create method from user, what's the benefit of using it?
    if($test->isLoggedIn() ){
        if(Input::exists() && Token::check(Input::get('token'))){
            $test->testSpaceInsert(Input::get('objName'), Input::get('price'), Input::get('sqm'));
        }
    ?>
    <body>
        <br>
        <h2>List your space</h2>
        <p>Please enter information about the space that you're interested in renting out</p>

        <form action="" method="post">
  
            <div class= "field">
                <label for="objName">Name of listing</label>
                <input type="text" name="objName" id="objName">
            </div>

            <div class="field">
                <label for="sqm">Size of storage</label>
                <input type="number" name="sqm" value="">
            </div>

            <div class="field">
                <label for="price">Price</label>
                <input type="number" name="price" value="">
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