<?php
$addr = $_POST['addr'];
if(isset($addr)){
    if(!(preg_match('/^\w+\..*\w+\.\w+$/',$addr))){
    die("Invalid domain format.");
    }else{
    # Execute command!
    echo exec("/bin/ping -c 4 ".$addr);
    }
}
?>