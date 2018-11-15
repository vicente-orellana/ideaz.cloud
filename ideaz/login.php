<?php
	session_start();
	include_once("includes/functions.php");
	require("includes/config.php");

	if (!isset($_SESSION["id"])):

		include("includes/login.php");
	
	else:
		
		header("Location: /");
	
	endif;
?>