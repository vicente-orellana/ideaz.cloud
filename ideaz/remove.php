<?php
	session_start();
	require("includes/config.php");

	// ensure method is post
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/remove.php");
	}
	else
	{
		header("Location: /");
	}
?>