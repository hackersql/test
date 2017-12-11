<?php
if (isset($_POST["addr"])){
    if (base64_encode(base64_decode($_POST["addr"])) === $_POST["addr"]){
      if( stristr(php_uname('s'), 'Windows NT')){
        # Windows-based command execution.
        echo exec('ping '.base64_decode($_POST["addr"]));
      } else {
        # Execute command!
        echo exec("/bin/ping -c 4 ".base64_decode($_POST["addr"]));
      }
    } else {
        echo 'Please, encode your input to Base64 format.';
    }
}
?>