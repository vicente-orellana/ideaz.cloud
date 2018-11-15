<?php
	require("includes/config.php");
	include_once("includes/functions.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/update_profile.php");
	}
	else
	{
		header("Location: /user_cp");
	}
?>