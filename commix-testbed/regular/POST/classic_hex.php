<?php
if (isset($_POST["addr"])){
    if (bin2hex(pack('H*', $_POST["addr"])) === $_POST["addr"]){
      if(stristr(php_uname('s'), 'Windows NT')){
        # Windows-based command execution.
        echo exec("ping ".pack('H*', $_POST["addr"]));
      } 
      else {
        # Execute command!
        echo exec("/bin/ping -c 4 ".pack('H*', $_POST["addr"]));
        }
    } 
    else {
        echo 'Please, encode your input to hex format.';
    }
}
?>