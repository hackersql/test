<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Matches the characters ";","|","&","$"
    if(preg_match('/;|\||&|\$/',$addr)){
        die("Hack attempt detected!");
        }else{
        # Execute command!
        echo exec("/bin/ping -c 4 ".$addr);
        }
}
?>