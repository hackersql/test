<?php
  $addr = $_POST['addr'];
  if (preg_match('/\s/',$addr)){
    exit("No white spaces are allowed!");
  }else{
  if( stristr(php_uname('s'), 'Windows NT')){
    # Windows-based command execution.
    echo exec('ping '.$addr);
  } else {
    # Unix-based command execution.
    echo exec("/bin/ping -c 4 ".$addr);
  }
  }
?>