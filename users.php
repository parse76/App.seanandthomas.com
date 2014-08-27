<?php

    require '../connectParse.php'; //PARSE LIBRARY
    use Parse\ParseQuery; //object class

    //get info from Texters where auth is 1
    $query = new ParseQuery("Texter");
    $query->equalTo("auth", 1);
    $results = $query->find();

    // Do something with the returned ParseObject values
    for ($i = 0; $i < count($results); $i++) { 
        $object = $results[$i];
        $userID = $object->getObjectId();
        $userName = $object->get("name");
        echo 'Go To Conversation: <a href="http://app.seanandthomas.com/admin/conversation11.php?id=' . $userID . '"> '. $userName . '</a></br>';
    }
    
   

?>