<?php
class User{
    private $_db;

    public function __construct($user = null){
        $this->_db = DB::getInstance();
    }

    #Ability to create user
    public function create($fields = array()){
        if(!$this->_db->userInsert('users', $fields)){
            throw new Exception('There was a problem creating the account');
        }
    }

}