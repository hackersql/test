<?php
if (isset($_GET["user"])){
# Execute command!
$dyn_function = create_function('', "echo \"Hello, ".$_GET['user']."!\";");
$dyn_function(''); 

}
?>