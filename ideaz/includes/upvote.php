<?php
    if (isset($_SESSION["id"]))
	{
		// variables
		$thread_id = $_POST["thread_id"];
		$user_id = $_POST["user_id"];
		$upvote_val = $_POST["upvote"];

		// combine currnt voted users with our user
		$sql = "SELECT * FROM threads WHERE id = $thread_id";
		$result = $conn->query($sql);

		$row = $result->fetch_assoc();

		// add user to voted users if val = 1
		if ($upvote_val == 1)
		{
			$vote_users = $row["vote_users"] . $user_id;
			$sql = "UPDATE threads SET vote_users = '$vote_users', upvotes = upvotes + 1 WHERE id = $thread_id";
			$result = $conn->query($sql);
		}
		else
		{
			$vote_users = str_replace($user_id, "", $row["vote_users"]);
			$sql = "UPDATE threads SET vote_users = '$vote_users', upvotes = upvotes - 1 WHERE id = $thread_id";
			$result = $conn->query($sql);
		}
	}
?>