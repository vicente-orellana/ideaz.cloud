<?php
	session_start();
	require("includes/config.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/edit.php");
	}
	else
	{
		header("Location: /");
	}
?>