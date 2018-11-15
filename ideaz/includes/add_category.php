<?php
    include("config.php");
	include("functions.php");

	// initialize variables from POST
	$title = $_POST["title"];
	
	$title = make_safe($title, $conn);

	// initialize json array
	$array = array(
		"error" => ""
	);

	// check if category already exists
	$sql = "SELECT * FROM categories WHERE title = '$title'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		$array["error"] = "Category already exists.";
	}
	else
	{
		$sql = "INSERT INTO categories (title, threads) VALUES ('$title', 0)";
		$result = $conn->query($sql);
	}
	
	echo stripslashes(json_encode($array));
?>