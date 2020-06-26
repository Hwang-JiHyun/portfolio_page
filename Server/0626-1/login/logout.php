<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['name']);
header("Location:http://192.168.56.101/main/page_main.php");
?>