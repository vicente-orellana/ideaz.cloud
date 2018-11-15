<?php
	include_once("templates/head.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include("includes/upvote.php");
	}

	include_once("templates/foot.php");
?>