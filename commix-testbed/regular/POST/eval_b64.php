<?php
if (isset($_POST["user"])){
    if (base64_encode(base64_decode($_POST["user"])) === $_POST["user"]){
        eval("echo \"Hello, ".base64_decode($_POST["user"])."!\";");
    } else {
        echo 'Please, encode your input to Base64 format.';
    }
}
?>