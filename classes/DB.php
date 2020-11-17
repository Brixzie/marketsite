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
    Purpose:    Creates an instance of the class if one doesnt already exist
                Singleton pattern that checks if there already exists an object from this class
                This makes it so that we don't have to constantly be reconnecting to our DB
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

    public function query($sql, $params = array()){
        $this->_error = false; #resets error to false as it might be set to something else from a previous query
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            if(count($params)){
                foreach($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }else{
                $this->_error = true;
            }
        }

        return $this; #returns current object
    }


    #Understand this method

    public function action($action, $table, $where = array()){
        if(count($where) == 3){
            $operators = array('=', '<', '>', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)){
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                
                if(!$this->query($sql, array($value))->error()){
                    return $this;
                }
            }
        }
        return false;
    }

    public function get($table, $where){
        return $this->action('SELECT *', $table, $where);
    }

    public function insert($table, $fields = array()){
        #if(count($fields)){ #understand why you can remove this (#10, 10.30)
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            #loops through each field and adds a ,
            #can't just do "?," since it would add one on the last one
            foreach($fields as $field) {
                $values .= "?";
                if($x <count($fields)){ #count is a built in function?
                    $values .= ', ';
                }
                $x++;
            }

            #die($set);

        $sql = "INSERT INTO users (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
            #echo $sql; #example of the sql
            if($this->query($sql,$fields)->error()){
                return True;
            }
        #}
        return false;
            
    }

    public function update($table, $id, $fields){
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

    public function delete($table, $where){
        return $this->action('DELETE', $table, $where);
    }

    public function results(){
        return $this->_results;
    }

    public function error(){
        return $this->_error;
    }

    public function first(){
        return $this->_results[0]; #Can update to use results function
    }
    public function count(){
        return $this->_count;
    }



}