<?php
    if (isset($_SESSION["id"]))
	{
		$body = $_POST["body"];
		$body = make_safe($body, $conn);
		$user_id = $_SESSION["id"];
		$user_id = make_safe($user_id, $conn);
		$thread_id = $_POST["thread_id"];

		$sql = "INSERT INTO posts (body, user_id, thread_id) VALUES ('$body', '$user_id', '$thread_id');";
		$sql .= "UPDATE threads SET posts = posts + 1 WHERE id = '$thread_id';";
		$sql .= "UPDATE users SET posts = posts + 1 WHERE id = $user_id;";

		if ($conn->multi_query($sql) === TRUE)
		{
			header("Location: /");
		}
	}
	else
	{
		header("Location: /");
	}
?>