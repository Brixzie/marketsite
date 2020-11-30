<?php

/*
General purpose and attributes of class:
    Database wrapper
    PDO
    Singleton Pattern
    Since constructor is private, it can only be instantiated through static function getInstance()

*/


class DB{

    private static $_instance = null; #Stores an instance of the DB
    private $_pdo, #where we store the pdo object
            $_query, #last query executed
            $_error = false, 
            $_results, #store results from query
            $_count = 0; #store the count from the query

            
    /*
    Purpose:           
    How:                   
    Methods:   
    Params: 
    */
    private function __construct(){
        try{
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' .Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password')); 
            #print('Connected!');
        } catch(PDOException $e){
            die($e->getMessage());
        }
    }

    public function newUpdate($table, $sql){
        query($sql, $fields);
    }

    public function newInsert($table, $sql){
        query($sql, $fields);
    }


    /*
    Purpose:    Creates an instance of the class if one doesnt already exist
                Singleton pattern that checks if there already exists an object from this class
                This makes it so that we don't have to constantly be reconnecting to our DB
                Sets the $_instance 
    How:                   
    Methods:   
    Params: 
    */
    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    
    /*
    Purpose:    Prepared statement?
                Handles queries and returns..
                
                
    How:        Sets _error to false incase it's been previously changed
                Sets _query to object returned by PDO prepare($sql)
                If the $sql passed to prepare is invalid, it will still return true. It seems to be execute
                that returns false and sets _error to true.
                Updates $_count with PDO method rowCount()         
    Methods:    PDO::prepare() - 
                PDO::execute() -
                PDO::bindValue() - Binds a value to a corresponding named or question mark placeholder in the SQL statement that was used to prepare the statement.https://www.php.net/manual/en/pdostatement.bindvalue.php
                PDO::rowCount() - Returns row count
    Params:     $sql -
                $params - 

    */
    public function query($sql, $params = array()){
        $this->_error = false; #resets error to false as it might be set to something else from a previous query
        if($this->_query = $this->_pdo->prepare($sql)){ #sets $_query to the 
            $x = 1;
            if(count($params)){ #Assigns arrays to questionmarks
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()){ #executes the query
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }

        return $this; #returns current object
    }


    /*
    Purpose:           
    How:                   
    Methods:  PHP function in_array($value1, $value2) - checks if value2 exists in array array $value1
    Params: 
    */

    #example $action = "SELECT *" $table = "users" $where has 3 elements "name" "=" "Jon"
    public function action($action, $table, $where = array()){
        if(count($where) == 3){ #3=field, operator, and value (username = Doe)
            $operators = array('=', '<', '>', '>=', '<='); #Defines operators that are okay
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)){ #check if $operator is inside the $operator array
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                #$sql = "{$action} FROM '{$table}' WHERE {$field} {$operator}  '{$value}'";
                if(!$this->query($sql, array($value))->error()){ #questionmark gets replaced by $value. If not error proceed
                    return $this;
                }
            }
        }
        return false;
    }
    
    /*
    Purpose: Passes 'SELECT * as action parameter to action'           
    How:                   
    Methods:   
    Params: 
    */
    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    /*
    Purpose:           
    How:                   
    Methods:   
    Params: 
    */
    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }


    #specific for users?
    public function userInsert($table, $fields = array()){
        #if(count($fields)){ #understand why you can remove this (#10, 10.30)
            $keys = array_keys($fields);
            $values = '';
            $x = 1; #Why not zero?

            #loops through each field and adds a ,
            #can't just do "?," since it would add one on the last one

            

            foreach($fields as $field) {
                $values .= "?";
                #if there's another argument we add another ','
                if($x < count($fields)){ #count is a built in function?
                    $values .= ', ';
                }
                $x++;
            }

            #die($set);
            #specific for users?

            #update this to $table
            #$sql = "INSERT INTO $table (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            $sql = "INSERT INTO users (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            #echo $sql; #example of the sql

            if(!$this->query($sql,$fields)->error()){
                return True;
            }
        #}
        echo "This went wrong in userInsert!!<br>";
        return false;
            
    }

    public function userUpdate($table, $id, $fields){
        $set = '';
        $x = 1;

        foreach($fields as $name => $value){ #what's $value?
            $set .= "{$name} = ?";
            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;
        }
        #die($set);

        $sql = "UPDATE {$table} SET {$set} WHERE userID = {$id}";
        #echo $sql;
        if(!$this->query($sql, $fields)->error()){
            return true;
        }
        return false;
    }

    

    /*
    Purpose: Returns $_results           
    How:                   
    Methods:   
    Params: 
    */
    public function results(){
        return $this->_results;
    }
    
    /*
    Purpose:           
    How:                   
    Methods:   
    Params: 
    */
    public function first(){
        return $this->_results[0]; #Can update to use results function
    }
    
    /*
    Purpose:           
    How:                   
    Methods:   
    Params: 
    */
    public function error(){
        return $this->_error;
    }
 
    /*
    Purpose:  Returns _count          
    How:                   
    Methods:   
    Params: 
    */
    public function count(){
        return $this->_count;
    }

/*
public function action($action, $table, $where = array()){
 
   $x=1;
   $wherestatement ="";
   $operator = '';
   $dbvalues= array();

  foreach ($where as $column => $columnvalues) {
   $dbcolumn = $column;
   if ($x==1) {
    $wherestatement ="1 ";
   }
   foreach ($columnvalues as $values => $value) {
    if ($values =='operator') {
     $operator=$value;
    }else{
     $dbvalues[]=$value;
    }
    
   }
   $wherestatement .=' AND '.$dbcolumn." ".$operator."?";
   $x++;
  }
  $sql = "{$action} FROM {$table} WHERE {$wherestatement} ";


  if (!$this->query($sql, $dbvalues)->error()) {
     return $this;
  }
  return false;

 }






index.php then look like 


$user =DB::getInstance()->get("users", array( 
     'username'=> array('operator'=>'=',
           'value'=>'thulane'), 
     'password'=> array('operator'=>'=',
           'value'=>'thu1223'), 
     ));








if (!$user->count()) {
 echo "no user";
}else{
 echo "ok!";
}


*/

}