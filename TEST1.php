<?php
require 'connectParse.php';

use Parse\ParseObject;
 
$testObject = ParseObject::create("TestObject");
$testObject->set("foo", "barrrr");
$testObject->save();

   
?>