<?php
# Execute command!
$addr = $_GET['addr'];
if(isset($addr)){
  exec("/bin/ping -c 4 ".$addr."> /dev/null &", $output, $return);
  if (!$return) {
    echo "The ip ".$addr." seems to be up and running!";
  } else {
    echo "The ip ".$addr." seems to be down!";
  }
}
            ?>