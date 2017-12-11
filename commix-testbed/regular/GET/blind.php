<?php
    # Execute command!
    $addr = $_GET['addr'];
    if(isset($addr)){
      if( stristr(php_uname('s'), 'Windows NT')){
        # Windows-based command execution.
        echo exec('ping  '.$addr, $output, $return);
      } else {
        # Unix-based command execution.
        exec("/bin/ping -c 4 ".$addr, $output, $return);
      }
      if (!$return) {
        echo "The ip ".$addr." seems to be up and running!";
      } else {
        echo "The ip ".$addr." seems to be down!";
      }
    }
?>