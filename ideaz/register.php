<?php
	session_start();
	include_once("includes/functions.php");
	include_once("includes/config.php");
	
	if (!isset($_SESSION["id"])):

		if ($_SERVER["REQUEST_METHOD"] == "POST"):
			
			include("includes/register.php");

		else:

			header("Location: /");

		endif;

	else:

		header("Location: /");

	endif;
?>