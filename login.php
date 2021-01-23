<?php include('templates/navbar.php'); ?>
<?php
require_once 'core/init.php';

if(Input::exists()){
    if(Token::check(Input::get('token'))){
        
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));
        
        if($validate->passed()){
            //log user in
            #echo "Logged in";
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);
            
            if($login){
               #echo 'Success';
               Redirect::to('index.php');
            }else {
                echo 'Failed login';
            }
        }else{
            foreach($validate->errors() as $error){
                echo $error, '<br>';
            }
        }
    }
}

?>
<form action="" method="post">
   
        <div class="password">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label"></label>
                <input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="email">
            </div>
            <!--<div class="field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" autocomplete="off">
            </div>-->

            <div class="field">
                <div class="mb-3">
                    <label for="password" class="form-label"></label>
                    <input type="text" class="form-control" name="password" id="password" placeholder="Lösenord">
                </div>
                <!--<label for="password">Password</label>
                <input type="text" name="password" id="password" autocomplete="off">-->

                <div class="mb-3">
                    <label for="remember">
                        <input type="checkbox" name="remember" id="remember"> Remember me
                    </label>
            </div>


            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" value="Log in">
        </div>


</form>