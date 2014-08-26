<?php

//use class to run queries

class sqlQueries
{
    
    // property declaration
    public $var = 'a default value';

    // method declaration
    public function displayVar() {
        echo $this->var;
    }
    
    public function getUserID($phoneNumber){
        //get the current userID
        //pass the method a phone number
        //return a decimal variable
        
        $result = $con->query("SELECT * FROM user WHERE user_phone = $user_phone ");
        return $userID;
        
    }
    
    
    //assuming the user is in only ONE conversatoin
    //get all the messages in a conversation
    //pass the method a userid
    //return an array 
    
    //insert message into table
    //pass method message, phone number
    //return nil
    
    //insert user info
    //pass the method name and phone
    //return nil
    
    //insert messages
    //pass the method userid, phone, message content
    //return nil
    
    //get user phone number based on user id
    //pass userphone
    //return dec with user id
    
    //mark user as authenticated
    //pass userid
    //return nil
    
    //check if authenticated
    //pass user id
    //return bool
    
    //get list of auth users
    //pass bool
    //return array
}
?>