<?php
session_start();
    $username = $_REQUEST["username"];
    $_SESSION["username"] = $username;
    
    header("location:guess_number.php");
    

?>