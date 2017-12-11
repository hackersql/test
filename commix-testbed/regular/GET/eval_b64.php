<?php
if (isset($_GET["user"])){
    if (base64_encode(base64_decode($_GET["user"])) === $_GET["user"]){
        eval("echo \"Hello, ".base64_decode($_GET["user"])."!\";");
    } else {
        echo 'Please, encode your input to Base64 format.';
    }
}
?>