<?php

    /// SEND INITIAL TEXT MESSAGE, INSERT INTO DATABASE, AND EXIT WITH SUCCESS
    require "twilio/Services/Twilio.php"; //twilio library
    require 'config/twilio-connect.php';    //twilio credentials...not sure if this will work
    require 'connectParse.php'; //PARSE LIBRARY
 
    //Parse//
    ////////
    use Parse\ParseObject;

    //variables to get from webform
    $name = "Sean";
    $userPhone = "+13306714458";  

    //New User Sign UP
    $texter = new ParseObject("Texter");
    $texter->set("name", $name);
    $texter->set("phone", $userPhone);
    $texter->set("auth", 0);

    $texter->save();

    
    ////Send confirmation text////
    /////////////////////////////
    $sms = $client->account->messages->sendMessage(
    $twilio_num, $userPhone, "Hey " . $user_Name . ", thanks for signing up with OTP! But before we get started, text us back with 'GYPSY' just so we know for sure you are human :)");
 

    if (!$sms) {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send text message!'));
		die($output);
    }
    
    else{
		$output = json_encode(array('type'=>'message', 'text' => "Hi ".$user_Name .", thanks for signing up with OTP! You'll receive a text message soon to confirm your subsciption."));
		die($output);
	}


?>
