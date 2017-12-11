<?php
  $msg = 'Hello, World!';
  $replace = $_POST['replace'];
  $with = $_POST['with'];
  if (isset($replace, $with)){
    # Execute command!
    echo preg_replace($replace, $with, $msg);
  } else {
    echo $msg;
  }
?>