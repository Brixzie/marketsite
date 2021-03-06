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


    /*
    Called from: register.php
    Purpose: checks the content of $_post as well as an array containing all the rules         
    How:     compares the two                      
    Methods:   
    Params: 
    */
    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                
                #echo $value;
                #echo "{$item} {$rule} must be {$rule_value}<br>";
                #check requirements 
                #=== identical operator, checks both value and data type
                $value = $source[$item];
                #understand this
                $item = escape($item);
            
                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is required");
                }else if(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                              $this->addError("{$item} must be a minimum of {$rule_value} characters");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters");
                            }
                          
                        break;
                        case 'matches': #Understand this part
                            if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}");
                            }
                        break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if($check->count()){
                                $this->addError("{$item} already exists.");
                            }
                        break;
                    }
                }
            }
        }
        #Check if error array is empty
        if(empty($this->_errors)){
            $this->_passed = true;
        }
    }

    private function addError($error){
        $this->_errors[] = $error;
    }
    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}
?>