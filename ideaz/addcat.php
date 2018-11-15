<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/add_category.php");
	}
	else
	{
		header("Location: /");
	}
?>