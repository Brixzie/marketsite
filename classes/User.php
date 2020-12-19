<?php
class User{
    private $_db,
            $_data,
            $_sessionName,
            $_isLoggedin;

    #Creates instance to DB &
    
    public function __construct($user = null){
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('session/session_name');
        
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
        if(!$this->_db->userInsert('users', $fields)){
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
    public function login($username = null, $password = null, $remember){
        
        $user = $this->find($username);
        if($user){
            #This is obviously always gonna match, need to check with hash and salt in future
            ##echo $this->data()->password;
            #if($this->data()->password == $this->data()->password){
            if($this->data()->password == Hash::make($password, $this->data()->salt)){
                echo "Success!";
                #set session
                Session::put($this->_sessionName, $this->data()->userID);
                
                if($remember){
                    #$hash = Hash::unique();
                    #$hashCheck = 
                }
                return true;
            }
        }
        return false;
    }


    public function testing(){
        $password = 'mary123';
        $user = $this->find('mary123'); //This sets _data to the finding
        echo Hash::make($password, $this->data()->salt);
    }

    public function logout(){
        Session::delete($this->_sessionName);
    }

    public function data(){
        return $this->_data;
    }

    public function isLoggedIn(){
        return $this->_isLoggedin;
    }
}