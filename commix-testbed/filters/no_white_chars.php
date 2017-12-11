<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Matches any white space character [\r\n\t\f ]
    if(!(preg_match('/\s+/',$addr))){
            echo exec("/bin/ping -c 4 ".$addr);
    }else{
            die("Invalid IP format.");
    }
 }
?>