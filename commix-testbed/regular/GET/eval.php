<?php
if (isset($_GET["user"])){
  # Execute command!
  eval("echo \"Hello, ".$_GET['user']."!\";");
}
?>