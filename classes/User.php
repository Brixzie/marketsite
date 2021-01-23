<?php
class User{
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $_isLoggedin;

    #Creates instance to DB &
    
    public function __construct($user = null){
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
        if(!$user){
            if(Session::exists($this->_sessionName)){
                $user = Session::get($this->_sessionName);
                #echo $user;
                #echo $this->find($user);

                if($this->find($user)){
                    #echo "found it";
                    $this->_isLoggedin = true;
                }else{
                    //Process logout
                }
            }
        } else{
            $this->find($user);
        }
    }


    #Ability to create user
    public function create($fields = array()){
        if(!$this->_db->insert('users', $fields)){
            throw new Exception('There was a problem creating the account');
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'userID' : 'username';//this would fail on users who only use digits for username
            $data = $this->_db->get('users', array($field, '=', $user));
            if($data->count()){
                $this->_data = $data->first(); 
                return true;
            }
        }
    }
    public function login($username = null, $password = null, $remember = false){

        #Finds the username passed into the method
        

        if(!$username && !$password && $this->exists()){
            Session::put($this->_sessionName, $this->data()->userID);
        }else{
            $user = $this->find($username);

            if($user){
                #check that passed password matches
                if($this->data()->password == Hash::make($password, $this->data()->salt)){
                    ?>
                    <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    This is an alert box.
                    </div>
                    
                    <?php

                    #set session
                    Session::put($this->_sessionName, $this->data()->userID);
                    
                    #Create a cookie
                    if($remember){
                        #Redirect::to('register.php');
                        $hash = Hash::unique(); # creates a unique hash
                        $hashCheck = $this->_db->get('user_session', array('user_id', '=', $this->data()->userID));
                        #This will be triggered as long as it's not stored in the database
                        if(!$hashCheck->count()){

                            #why isn't it create() (sanitize?)? Only for manual input?
                            $this->_db->insert('user_session',array(
                                'user_id' => $this->data()->userID,
                                'hash' => $hash
                            ));
                        }else{
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function exists(){
        return(!empty($this->_data)) ? true : false;
    }

    #public function testSearchSpace(){
        #takes params from checkboxes on site. This goes through if statement
        #$this->_db->get("users", array('available', '=', '0'));  
    #    $this->_db->get("users", array('username', '=', 'something'));  
    #}

 
    public function stopRenting($objID){
        $values = array(
            'renterID' => null,
            'available' => 0
        );
        $this->_db->renterUpdate('objects', $objID, $values);
    }

    public function rent($objID){
        $values = array(
            'renterID' => $this->data()->userID,
            'available' => 1
        );
        $this->_db->renterUpdate('objects', $objID, $values);
    }

    public function testSpaceInsert($name, $price, $sqm, $image){
        $date = date('h/m/d/Y', time());
        $values = array(
                        'userID' => $this->data()->userID,
                        'objName' => $name,
                        'sqm' => $sqm,
                        'price' => $price,
                        'images' => $image
                    );
       $this->_db->insert("objects", $values);
    }
    public function testUserInsert(){
        $date = date('h/m/d/Y', time());
        $salt = Hash::salt(32);
        $values = array(
                        'username' => "Dorryyy",
                        'password' => "Dorryyy",
                        'email' => "Dorryyy",
                        'created' => $date,
                        'salt' => $salt
                    );
       $this->_db->insert("users", $values);
    }

    public function testUserSessionInsert(){
        $values = array(
                        'user_id' => 1,
                        'hash' => 5
                    );
       $this->_db->insert("user_session", $values);
    }

    public function testFileInsert($name){
        $values = array(
                        'images' => $name
                    );
       $this->_db->insert("user_session", $values);
    }

    public function testing(){
        $password = 'mary123';
        $user = $this->find('mary123'); //This sets _data to the finding
        echo Hash::make($password, $this->data()->salt);
    }

    public function simpleMessage(){
        echo "simpleMessage";
    }

    public function logout(){
        #Deletes cookie in DB
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->userID));
        #Deletes session
        Session::delete($this->_sessionName);
        #Deletes cookie on computer
        Cookie::delete($this->_cookieName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedin;
    }
}