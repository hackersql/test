<?php 
   $user = str_replace(array("\\","'", '"'), "", $_POST["user"]); 
   eval("echo(\"$user\");"); 
?>