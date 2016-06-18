<?php session_start();
	$host = $_SESSION['host'];
	$user = $_SESSION['user'];
	$contrasena = $_SESSION['contrasena'];
	$db = $_SESSION['bd'];
	$con = new mysqli($host,$user,$contrasena,$db) or die("Error" .mysqli_error($con));
?>
