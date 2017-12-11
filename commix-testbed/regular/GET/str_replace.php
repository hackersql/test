<?php 
   $user = str_replace(array("\\","'", '"'), "", $_GET["user"]); 
   eval("echo(\"$user\");"); 
?>