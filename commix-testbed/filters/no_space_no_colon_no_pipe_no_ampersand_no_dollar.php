<?php
$addr = $_POST['addr'];
if(isset($addr)){
    # Matches the character " ".
    if(preg_match('/ /',$addr)){
        die("Invalid IP format.");
        }else{
        # Matches the characters ";","|","&","$"
        if(!(preg_match('/&|\||;|\$/',$addr))){
            echo exec("/bin/ping -c 4 ".$addr);
            }else{
            die("Hack attempt detected!");
    }
 }
}
?>