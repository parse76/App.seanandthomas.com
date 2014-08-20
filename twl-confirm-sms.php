<?php
require "twilio/Services/Twilio.php"; //twilio library
require 'config/db-connect.php';        //databse connect
require 'config/twilio-connect.php';    //twilio credentials

$user_phone = $_SESSION[phone]; //users phone from session in index file
$twilio_num = '+12247231922';  //twilio phone number

$sms = $client->account->messages->sendMessage(
            $twilio_num, $number, "Hey $name thanks for signing up with OTP! Respond with 'This is dope' to confirm your subsciption.");
 
echo "Sent message to $name "; // Display a confirmation message on the screen
        


?>