<?php
require '../connectParse.php'; //PARSE LIBRARY
use Parse\ParseQuery;
use Parse\ParseObject;

if($_POST) {
    
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
	if(!isset($_POST["userID"]) )
	{
		$output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
		die($output);
	}

	$id = $_POST["userID"]; // We get the darn user ID here

    
    //use Parse\ParseObject;
    
    ///////////////////////
    ///DISPLAY MESSAGES//// 
    ///////////////////////
    

    $humanTexter = new ParseObject("Texter", $id); //$currentTexter is set as the current Texter object
    $adminTexter = new ParseObject("Texter", "pJmpGkUVjh"); //$currentTexter is set as the current Texter object
    $query = new ParseQuery("Messages"); //new query on the Mesages class
    $query->containedIn("texter",
                  [$adminTexter, $humanTexter]);
    $query->ascending("createdAt");
    $results = $query->find(); //$results now contains the output of all messages with $id userID



    //loop through the messages
    for ($i = 0; $i < count($results); $i++) { 
        $object = $results[$i]; //object of type "Message" first message incremented up each time
        $messageContent = $object->get("content"); //gets the content of the message
        $texterObject = $object->get("texter"); //set a new object to the 'texter' object
        $texterObject->fetch(); //call the info for that object
        $username = $texterObject->get("name"); //get the name from the associated Texter
        //query for Texter object info
        
        echo $username.': <strong>'.$messageContent. '</strong></br></br>';
    }
    
}
?>