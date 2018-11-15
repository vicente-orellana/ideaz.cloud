<?php
    // check if deleting thread or post
	if (isset($_POST["thread_id"]))
	{
		$thread_id = $_POST["thread_id"];

		// get category id for decrement
		$sql = "SELECT * FROM threads WHERE id = $thread_id";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();

		$uid = $rows["user_id"];
		$category_id = $rows["category_id"];
		
		// update user posts
		$sql = "UPDATE users SET posts = posts - 1 WHERE id = $uid";
		$conn->query($sql);

		// delete thread
		$sql = "DELETE FROM threads WHERE id = $thread_id;";
		$sql .= "UPDATE categories SET threads = threads - 1 WHERE id = $category_id";
		$result = $conn->multi_query($sql);
	}
	else if (isset($_POST["post_id"]))
	{
		$post_id = $_POST["post_id"];

		// get user id for decrement
		$sql = "SELECT * FROM posts WHERE id = $post_id";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();

		// get user id and thread id
		$uid = $rows["user_id"];
		$thread_id = $rows["thread_id"];

		// update user posts
		$sql = "UPDATE users SET posts = posts - 1 WHERE id = $uid";
		$conn->query($sql);
		
		// decrement thread posts
		$sql = "UPDATE threads SET posts = posts - 1 WHERE id = $thread_id";
		$conn->query($sql);

		// delete post
		$sql = "DELETE FROM posts WHERE id = $post_id";
		$result = $conn->query($sql);
	}
?>