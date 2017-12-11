<?php
// JSON request format:
// {"name":"ancst"}
// read JSon input
$data_back = json_decode(file_get_contents('php://input'));
// set json string to php variables
$name = $data_back->{"name"};
// create json response
$responses = array("User" => array("Name", eval("echo \"Hello, ".$name."!\";")));
echo json_encode($responses);
?>