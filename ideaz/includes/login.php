<?php
    // prep json array
	$array = array(
		"error" => ""
	);

	if ($_SERVER["REQUEST_METHOD"] == "POST"):
		// set post variables
		$username = make_safe($_POST["username"], $conn);
		$password = make_safe($_POST["password"], $conn);

		if (!empty($username) && !empty($password)):
			// create sql statement
			$sql = "SELECT * FROM users WHERE username='$username'";

			$rows = $conn->query($sql);

			if ($rows->num_rows > 0):
				// check password
				$row = $rows->fetch_assoc();

				if (password_verify($password, $row["password"])):

					$_SESSION["id"] = $row["id"];
					$_SESSION["username"] = $row["username"];

					// check if admin
					if ($row["is_admin"] == 1)
					{
						$_SESSION["is_admin"] = 1;
					}
					else
					{
						$_SESSION["is_admin"] = 0;
					}
				else:
					$array["error"] = "Incorrect username and/or password.";
				endif;

			else:
				$array["error"] = "Incorrect username and/or password.";
			endif;

		endif;

		echo stripslashes(json_encode($array));

	else:

		header("Location: /");

	endif;
?>