<?php
session_start();


if (!isset($_SESSION["username"])) {
    header('Location: ../../index.php');
    exit();
}


if (!isset($_SESSION["user_type"]) || strtolower($_SESSION["user_type"]) !== 'admin') {
    header('Location: ../../pages/home.php'); 
    exit();
}

?>