<?php
if (isset($_POST["user"])){
# Execute command!
$dyn_function = create_function('', "echo \"Hello, ".$_POST['user']."!\";");
$dyn_function(''); 

}
?>