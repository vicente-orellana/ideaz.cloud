<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/upload.php");
	}
	else
	{
		header("Location: /");
	}
?>