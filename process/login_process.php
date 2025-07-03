<?php 

session_start(); 
$_SESSION['user'] = $_POST['email']; 
header('Location: ../pages/home.php'); 

?>