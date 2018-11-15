<?php
	// define hostname
	define("HOST", "localhost");

	// define username
	define("USER", "EDITME");

	// define password
	define("PASS", "EDITME");

	// define db
	define("DB", "ideazcloud");

	// create new connection
	global $conn;

	$conn = new mysqli(HOST, USER, PASS, DB);

	// check if connection worked
	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}
?>