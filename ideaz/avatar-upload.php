<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/avatar_upload.php");
	}
	else
	{
		header("Location: /");
	}
?>