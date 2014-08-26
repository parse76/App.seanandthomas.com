<?php
require 'config/connect-parse.php';

    use Parse\ParseObject;
    
    $userInfo = new ParseObject("userInfo");
 
    $user_Name = "Sean Crowe";
    $userInfo->set("userName", $user_Name);
    $userInfo->set("playerName", "Sean Plott");
    $userInfo->set("cheatMode", false);

    try {
      $userInfo->save();
      echo 'New object created with objectId: ' . $userInfo->getObjectId();
    } catch (ParseException $ex) {  
      // Execute any logic that should take place if the save fails.
      // error is a ParseException object with an error code and message.
      echo 'Failed to create new object, with error message: ' + $ex->getMessage();
    }
 
?>