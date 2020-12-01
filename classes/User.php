<?php
class User{
    private $_db,
            $_data,
            $_sessionName;

    public function __construct($user = null){
        $this->_db = DB::getInstance();

        $this->_sessionName = Config::get('session/session_name');
    }

    #Ability to create user
    public function create($fields = array()){
        if(!$this->_db->userInsert('users', $fields)){
            throw new Exception('There was a problem creating the account');
        }
    }

    public function find($user = null){
        if($user){
            $field = (is_numeric($user)) ? 'id' : 'username';//this would fail on users who only use digits for username
            $data = $this->_db->get('users', array($field, '=', $user));
            if($data->count()){
                $this->_data = $data->first(); 
                return true;
            }
        }
    }
    public function login($username = null, $password = null){
        
        $user = $this->find($username);
        if($user){
            #This is obviously always gonna match, need to check with hash and salt in future
            if($this->data()->password == $this->data()->password){
                echo "Success!";
                #set session
                Session::put($this->_sessionName, $this->data()->userID);
                return true;
            }
        }
        return false;
    }

    private function data(){
        return $this->_data;
    }
}