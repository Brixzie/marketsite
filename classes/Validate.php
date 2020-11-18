<?php

#Properties: Detect if passed if not, 
#check if errors and store errors, 
#ability to create an instance of DB.
class Validate{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    
    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                #$value = $source[$item];
                echo "{$item} {$rule} must be {$rule_value}<br>";
            }
        }
    }
}
?>