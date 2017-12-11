<?php
    $addr = $_POST['addr'];
    if(isset($addr)){
        # Inspired from pentesterlab.com - 'Web for Pentester' course.
        # https://pentesterlab.com/exercises/web_for_pentester
        if (!(preg_match('/^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$/m', $addr))){
           die("Invalid IP address format.");
        } else {
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
    }
?>