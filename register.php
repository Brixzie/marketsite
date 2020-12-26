<?php 
    require 'core/init.php';
    include('templates/navbar.php'); 
?>
<?php
    

    #var_dump(Token::check(Input::get('token')));

    if(Input::exists()){
        if(Token::check(Input::get('token'))){
            #echo "I am allowed to run";
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'password' => array(
                    'required' => true,
                    'min' => 6
                ),
                'password_again' => array(
                    'required' => true,
                    'matches' =>'password'
                ),
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                )
                ));

            if($validate->passed()){
                $user = new User();
                
                #die();
                $date = date('h/m/d/Y', time());
                $salt = Hash::salt(32);
                try{
                    $user->create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'email' => Input::get('email'),
                        'created' => $date,
                        'salt' => $salt
                    ));

                }catch(Exception $e){
                    #echo "Now in the catch of register.php <br>";
                    die($e->getMessage());
                }
                Session::flash('success', 'You registered successfully!');
                #header('Location: index.php');
                #Redirect::to(404);
                Redirect::to('index.php');
            }    else{
                #print_r($validate->errors());
                foreach($validate->errors() as $error){
                    echo $error, '<br>';
                }
            }
            #echo Input::get('username');
        }
    }
    /*
    if(Input::exists()){
        echo "Submitted";
    }else{
        echo "Not submitted";
    }
    */
?>


<form action="" method="post">
    <div class="field">
        <label for="username">Username</label>
        <!-- understand escape() Also understand how it keeps data showing up in fields -->
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
    </div>
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

    <!-- Token is unique to the users page -->
    <input type = "hidden" name = "token" value ="<?php echo Token::generate(); ?>">
    <input type = "submit" value = "Register">

</form>
