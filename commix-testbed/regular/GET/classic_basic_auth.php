<?php
  $addr = $_GET['addr'];
  if( stristr(php_uname('s'), 'Windows NT')){
    # Windows-based command execution.
    echo exec('ping '.$addr);
  } else {
    # Unix-based command execution.
    echo exec("/bin/ping -c 4 ".$addr);
  }
?>