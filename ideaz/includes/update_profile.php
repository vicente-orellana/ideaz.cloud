<?php
    // get variables from form
	$id = $_POST["user_id"];
	$about = $_POST["about-me"];
	$current_pw = $_POST["curr"];
	$new_pw = $_POST["new"];
	$confirm = $_POST["new_c"];
	$email = make_safe($_POST["email"], $conn);

	// create json array
	$array = array(
		"password_error" => "",
		"email_error" => ""
	);

	// update about me
	if (!empty($about))
	{
		$sql = "UPDATE users SET about = '$about' WHERE id = $id";
		$result = $conn->query($sql);
	}
	
	// check passwords
	if (!empty($current_pw) && !empty($new_pw) && !empty($confirm))
	{
		$sql = "SELECT * FROM users WHERE id = $id";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		if (!password_verify($current_pw, $row["password"]))
		{
			$array["password_error"] = "Incorrect current password.";
		}
		else if ($confirm != $new_pw)
		{
			$array["password_error"] = "New password and confirmation do not match.";
		}
		else
		{
			$new_pw = password_hash($new_pw, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password = '$new_pw' WHERE id = $id";
			$result = $conn->query($sql);

			if (!$result)
			{
				$array["password_error"] = "Unable to change password.";
			}
		}
	}

	// check email
	if (!empty($email))
	{
		$sql = "UPDATE users SET email = '$email' WHERE id = $id";
		$result = $conn->query($sql);

		if (!$result)
		{
			$array["email_error"] = "Unable to update email.";
		}
	}

	// send back json array
	echo stripslashes(json_encode($array));
?>