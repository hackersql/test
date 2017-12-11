<?php
if (isset($_GET["addr"])){
    if (base64_encode(base64_decode($_GET["addr"])) === $_GET["addr"]){
      if( stristr(php_uname('s'), 'Windows NT')){
        # Windows-based command execution.
        echo exec('ping '.base64_decode($_GET["addr"]));
      } else {
        # Execute command!
        echo exec("/bin/ping -c 4 ".base64_decode($_GET["addr"]));
      }
    } else {
        echo 'Please, encode your input to Base64 format.';
    }
}
?>