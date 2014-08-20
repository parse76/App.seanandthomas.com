<?php
require 'config/db-connect.php';        //databse connect

//get the current phone number and put it in the variable user_phone

//now query to get the user id from user table using the phone number
$result = $con->query("SELECT * FROM user WHERE user_phone = $user_phone ");

//put result in an array then select the row and assign variable
while($row = $result->fetch_array()){ $user_id = $row['user_id']; }

//check to see if user is already authenicated, incase they replay twice
$result = $con->query("SELECT auth FROM user WHERE user_id = $user_id ");
while ($row = $result->fetch_assoc()) {
        $check = $row['auth'];
    }

//if check doesn't exist...error out
if (!$check){
  die($con->error);
}
//if the output has more than 0 rows...aka already authenicated
if ($check->num_rows > 0){
    //do something to alert user that he already is authenicated
    $authSuccess = false;
}else {
    //mark user as authenticaed by inserting into auth table
    $query = "UPDATE user SET auth = '1' WHERE user_id = '$user_id'"; 
    mysqli_query($con,$query);
    $authSuccess = true;
}

    

?>