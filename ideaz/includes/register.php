<?php
    // define variables
	$username = make_safe($_POST["username"], $conn);
	$password = make_safe($_POST["password"], $conn);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$confirmation = make_safe($_POST["confirmation"], $conn);
	$email = make_safe($_POST["email"], $conn);

	// create json array
	$array = array(
		"error" => ""
	);

	if (!empty($username) && !empty($password) && !empty($email) && password_verify($confirmation, $password))
	{
		// check if user already exists
		$sql = "SELECT * FROM users WHERE username = '$username'";
		
		$rows = $conn->query($sql);

		if ($rows->num_rows > 0)
		{
			$array["error"] = "Username is already in use.";
		}
		else
		{
			// check if email already exists
			$sql = "SELECT * FROM users WHERE email = '$email'";

			$rows = $conn->query($sql);

			if ($rows->num_rows > 0)
			{
				$array["error"] = "Email is already in use.";
			}
			else
			{
				// otherwise create our new user
				$sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

				if ($conn->query($sql) === TRUE)
				{
					$sql = "SELECT * FROM users WHERE username = '$username'";
					$rows = $conn->query($sql);

					if ($rows->num_rows > 0)
					{
						$row = $rows->fetch_assoc();

						$_SESSION["id"] = $row["id"];
						$_SESSION["username"] = $username;
					}
				}
				else
				{
					$array["error"] = "Unable to register. Please try again.";
				}
			}
		}
	}

	echo stripslashes(json_encode($array));
?>