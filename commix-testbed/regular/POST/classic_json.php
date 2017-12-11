<?php
// JSON request format:
// {"addr":"127.0.0.1","name":"ancst"}
// read JSon input
$data_back = json_decode(file_get_contents('php://input'));
// set json string to php variables
$addr = $data_back->{"addr"};
$name = $data_back->{"name"};
// create json response
$responses = array("Execution Result" => array("Address" => array("IP", $addr),
           "Done by" => array("User", $name),
           "Result" => array("Output", exec("/bin/ping -c 4 ".$addr))
           ));
echo json_encode($responses);
?>