<?php
if($_POST)
{
	$to_Email   	= "tennispolska@gmail.com"; //Replace with recipient email address
	$subject        = 'Ah!! My email from Somebody out there...'; //Subject line for emails
	
	
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	
		//exit script outputting json data
		$output = json_encode(
		array(
			'type'=>'error', 
			'text' => 'Request must come from Ajax'
		));
		
		die($output);
    } 
	
	//check $_POST vars are set, exit if any missing
	if(!isset($_POST["userName"]) || !isset($_POST["userPhone"]) )
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
		die($output);
	}

	//Sanitize input data using PHP filter_var().
	$user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
	$user_Phone       = filter_var($_POST["userPhone"], FILTER_SANITIZE_STRING);
	
	//additional php validation
	if(strlen($user_Name)<2) // If length is less than 2 it will throw an HTTP error.
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
		die($output);
	}
    
    $name_pattern = '/^[a-zA-Z ]*$/';
    preg_match($name_pattern, $user_Name, $name_matches);
        if(!$name_matches[0]) {
            $output = json_encode(array('type'=>'error', 'text' => "Let's make life simpler and not use crazy symbols :)"));
            die($output);
        }
    
    $phones = preg_replace("/[^0-9]/", '', $user_Phone);
    
    if(strlen($phones) != 10) {
        $output = json_encode(array('type'=>'error', 'text' => 'Hey now, we just need a 10 digit phone number.')); 
        die($output);
    }
	
    /// SEND INITIAL TEXT MESSAGE, INSERT INTO DATABASE, AND EXIT WITH SUCCESS
    require "twilio/Services/Twilio.php"; //twilio library
    require 'config/connect-parse.php'; //PARSE LIBRARY
    require 'config/twilio-connect.php';    //twilio credentials...not sure if this will work

    ////set variables////
    ////////////////////            
    $user_Phone = chr(43) . "1" . $phones;    //add a +1 in front of the phone to make twilio happy

    ////insert user info in database////
    ///////////////////////////////////
    use Parse\ParseObject;
    
    $userInfo = new ParseObject("userInfo");
 
    $userInfo->set("userName", $user_Name);
    $userInfo->set("userPhone", $user_Phone);

    //Save the object
    try {
      $userInfo->save();
      echo 'New object created with objectId: ' . $userInfo->getObjectId();
    } catch (ParseException $ex) {  
      // Execute any logic that should take place if the save fails.
      // error is a ParseException object with an error code and message.
      echo 'Failed to create new object, with error message: ' + $ex->getMessage();
    }

    
    ////Send confirmation text////
    /////////////////////////////
    $sms = $client->account->messages->sendMessage(
    $twilio_num, $user_Phone, "Hey " . $user_Name . ", thanks for signing up with OTP! But before we get started, text us back with 'GYPSY' just so we know for sure you are human :)");
 

    if (!$sms) {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send text message!'));
		die($output);
    }
    
    else{
		$output = json_encode(array('type'=>'message', 'text' => "Hi ".$user_Name .", thanks for signing up with OTP! You'll receive a text message soon to confirm your subsciption."));
		die($output);
	}

}
?>

