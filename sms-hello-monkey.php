<?php
    require 'connectParse.php'; //PARSE LIBRARY
    use Parse\ParseObject; //object class
    use Parse\ParseQuery; //object class


	echo '<?xml version="1.0" encoding="UTF-8" ?>';

    //user info grabbed from twilio api
    $userPhone = $_REQUEST['From'];
	$message = $_REQUEST['Body'];
    $twilioPhone = $_REQUEST['To']; //

    /*testing
    $userPhone = "+13306714458";
	$message = 'gypsy';
    settype($message, "string");
    settype($userPhone, "string");
    $twilioPhone = '+12247231922';*/

    //Query for the Texter ID based on phone number
    $query = new ParseQuery("Texter");
    $query->equalTo("phone", $userPhone);
    $results = $query->find();
    $currentUser = $results[0]; //set an object as the current user
    $userID=$currentUser->getObjectId();      //get the id of the current user
    
//check if authenticated her
    //If USER IS AUTHETICATED:
        //insert message into table
        $message = new ParseObject("Messages");
        $message->set("content",$message);
        $message->set("userID", $userID);
        $message->set("twilioPhone", $twilioPhone);
        $message->save();

        //twilio api shtuff
        echo '<Response>';
        echo '</Response>';

        echo '<Response>'; //Begin the response
        echo '<Message>';

     
        //update the user with auth number 
        $currentUser->set("auth",1);
        $currentUser->save();


        echo $response . '</Message>';
        echo '</Response>';
        
    

    
?>