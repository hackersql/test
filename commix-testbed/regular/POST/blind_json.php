<?php
// JSON request format:
// {"addr":"127.0.0.1"}
// read JSon input
$data_back = json_decode(file_get_contents('php://input'));
// set json string to php variables
$addr = $data_back->{"addr"};
// create json response
$responses = array("Execution Result" => array("Address" => array("IP", $addr),
   "Result" => array("Result", exec("/bin/ping -c 4 ".$addr, $output, $return))
   )
);
#echo json_encode($responses);
if (!$return) {
echo "The ip ".$addr." seems to be up and running!";
}else{
echo "The ip ".$addr." seems to be down!";
}
?>