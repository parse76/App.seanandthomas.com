<?php
    require 'connectParse.php'; //PARSE LIBRARY
    use Parse\ParseObject; //object class
    use Parse\ParseQuery; //object class


	echo '<?xml version="1.0" encoding="UTF-8" ?>';

    //user info grabbed from twilio api
    $userPhone = $_REQUEST['From'];
	$content = $_REQUEST['Body'];
    $twilioPhone = $_REQUEST['To']; //

    //Query for the Texter ID based on phone number
    $query = new ParseQuery("Texter");
    $query->equalTo("phone", $userPhone);
    $results = $query->find();
    $currentUser = $results[0]; //set an object as the current user
    $userID=$currentUser->getObjectId();      //get the id of the current user
    
    $adminObject = new ParseObject("Texter", 'pJmpGkUVjh'); //get the object of the admin id:1s2NJH1jAZ

//check if authenticated here
    //If USER IS AUTHETICATED:
        //insert message into table
        $message = new ParseObject("Messages");
        $message->set("content",$content);
        $message->set("texter", $currentUser);
        $message->set("receiver", $adminObject); //<- make this an object of type Texter. 
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