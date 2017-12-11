<?php
if (isset($_GET["addr"])){
    if (bin2hex(pack('H*', $_GET["addr"])) === $_GET["addr"]){
      if(stristr(php_uname('s'), 'Windows NT')){
        # Windows-based command execution.
        echo exec("ping ".pack('H*', $_GET["addr"]));
      } 
      else {
        # Execute command!
        echo exec("/bin/ping -c 4 ".pack('H*', $_GET["addr"]));
        }
    } 
    else {
        echo 'Please, encode your input to hex format.';
    }
}
?>