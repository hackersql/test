<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Matches the character " ".
    if(preg_match('/ /',$addr)){
        die("Invalid IP format.");
        }else{
        # Execute command!
        echo exec("/bin/ping -c 4 ".$addr);
        }
}
?>