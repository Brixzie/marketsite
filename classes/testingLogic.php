<?php
require 'core/init.php';



class test{
    private $_db;

    //Creates an instance of DB
    public function __construct($user = null){
        $this->_db = DB::getInstance();
    }

    public function simpleMessage(){
        echo "simpleMessage";
    }

    public function testInsert(){
        $date = date('h/m/d/Y', time());
        $salt = Hash::salt(32);
        $values = array(
                        'username' => "Dorryyy",
                        'password' => "Dorryyy",
                        'email' => "Dorryyy",
                        'created' => $date,
                        'salt' => $salt
                    );
       $this->_db.insert("users", $values);
    }


}

?>

