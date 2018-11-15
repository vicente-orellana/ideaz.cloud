<?php
    // check if thread
	if ($_POST["is_thread"])
	{
		$new_data = $_POST["new_data"];
		$thread_id = $_POST["thread_id"];

		$sql = "UPDATE threads SET body = '$new_data' WHERE id = $thread_id";
		$conn->query($sql);
	}
	// check if post
	else if ($_POST["is_post"])
	{
		$new_data = $_POST["new_data"];
		$post_id = $_POST["post_id"];

		$sql = "UPDATE posts SET body = '$new_data' WHERE id = $post_id";
		$conn->query($sql);
	}
?>