<?php
class Space{


    public function create($fields = array()){
        if(!$this->_db->insert('users', $fields)){
            throw new Exception('There was a problem creating the account');
        }
    }

    public function rent(){
        
    }

}


?>