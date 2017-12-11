<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Match any word character [a-zA-Z0-9_]
    if(preg_match('/\w+$/',$addr)){
        # Execute command!
        echo exec("/bin/ping -c 4 ".$addr);
    }else{
    die("Hack attempt detected!");
    }
}
?>