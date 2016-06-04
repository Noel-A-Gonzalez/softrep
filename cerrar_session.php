<?php 
	session_start();
	$_SESSION["user"] = array();
	session_destroy();
	header("location: index.php");
 ?>