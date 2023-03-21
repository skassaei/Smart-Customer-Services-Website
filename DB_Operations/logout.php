<?php
	include 'login.php';
	session_unset();
	session_destroy();
	$_SESSION = array();
	header("Location: ../home.php");
?>