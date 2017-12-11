<?php
  $addr = $_GET['addr'];
  if (isset($addr)){
    if(stristr(php_uname('s'), 'Windows NT')){
      # Windows-based command execution.
      echo exec("ping '".$addr."'");
    } else {
      # Unix-based command execution.
      echo exec("/bin/ping -c4 '".$addr."'");
    }
  }
?>