<?php
if (isset($_POST["user"])){
  # Execute command!
  eval("echo \"Hello, ".$_POST['user']."!\";");
}
?>