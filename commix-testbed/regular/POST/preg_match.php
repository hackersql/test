<?php
    $addr = $_POST['addr'];
    if(isset($addr)){
        # Inspired from pentesterlab.com - 'Web for Pentester' course.
        # https://pentesterlab.com/exercises/web_for_pentester
        if (!(preg_match('/^\d{1,3}.\d{1,3}.\d{1,3}.\d{1,3}$/m',$addr))){
            die("Invalid IP address format.");
        }else{
            # Execute command!
            echo exec("/bin/ping -c 4 ".$addr);
        }
    }
?>