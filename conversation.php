<?php
require 'config/db-connect.php';        //databse connect
require "twilio/Services/Twilio.php";  //TWILO FRAMEWORK
$id = $_GET['id'];                      //GET THE USER ID FROM THE URL SEND FROM USERS.PHP
$twilioNumber = '+12243741995';         //assign the twilio number that OTP will be sending from

//$query = "SELECT user_phone FROM user WHERE user_id = $id "; //get the selected users phone based on user id
//while ($row = $query->fetch_assoc()) {$userPhone = $row['user_phone'];} //store in variable $userPhone

///////////////////////
///DISPLAY MESSAGES//// 
///////////////////////
if($result = $con->query("SELECT * FROM messages WHERE sender = '$id' OR recipient = '$id' ORDER BY timestamp ASC")){
    if($result->num_rows){                          //if the query has a result, then dislpay data
        while($rows = $result->fetch_assoc()){      //loop through result and display mesages
            $userID = $rows['sender'];
            $content = $rows['content'];
            echo $userID.': '.$content, '</br></br>';
        }  
    }
}

/////////////////////////////////////
///INPUT FIELD WITH REPLY BUTTON///// 
/////////////////////////////////////
    



//1. OTP EMPLOYEE TYPES REPLY AND HITS THE SUBMIT BUTTON
//2. THAT MESSAGE IS SENT TO THE USER VIA TWILLIO NUMBER: +1-224-374-1995

    //this code is executed ON_CLICK of the REPLY button
    //send text to the userPhone number
    $sms = $client->account->messages->sendMessage($twilioNumber, $userPhone, $otpReply);
    echo "Sent message to $userID";
        
//3. THE MESSAGE is INSERTED INTO DATABASE -> make this a function...second time we've used it
    $otpReply = $con->real_escape_string($otpReply); //escape for special chars
    $query = "INSERT INTO messages(content, sender) VALUES ('$message','$twilioNumber')"; //sender is twil number for now...
    mysqli_query($con,$query);

//4. THE MESSAGE APPEARS IN THE ABOVE BOX WITHOUT HAVING TO REFRESH
//5. USER REPLIES AND MESSAGE APPEARS IN BOX WITHOUT REFRESHING




?>