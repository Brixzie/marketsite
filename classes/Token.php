<?php
    class Token{

        #Generates token
        public static function generate(){
            return Session::put(Config::get('session/token_name'), md5(uniqid()));
        }

        #Validates that the token matches the session
        public static function check($token){
            $tokenName = Config::get('session/token_name');

            if(Session::exists($tokenName) && $token === Session::get($tokenName)){
                Session::delete($tokenName);
                return True;
            }
            echo "This happened";
            return false;
        }
    }

    ?>