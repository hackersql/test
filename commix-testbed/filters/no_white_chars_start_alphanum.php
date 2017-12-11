<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Matches any white space character [\r\n\t\f ]
    if(preg_match('/\s+/',$addr)){
        die("Invalid IP format.");
        }else{
        # Matches any word character [a-zA-Z0-9_]
        if(preg_match('/^\w+/',$addr)){
            echo exec("/bin/ping -c 4 ".$addr);
        }else{
            die("Hack attempt detected!");
    }
 }
}
?>