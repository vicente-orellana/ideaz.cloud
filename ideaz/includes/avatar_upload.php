<?php
    // set user id
	$uid = $_SESSION["id"];

	// directory to upload to
	$dir = "uploads/";

	// get file type
	$type = pathinfo($dir . basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);

	// get file size
	$size = $_FILES["file"]["size"];

	// get temp name
	$temp = $_FILES["file"]["tmp_name"];

	// json array
	$array = array();

	// check if valid image extension
	if ($type == "png" || $type == "gif" || $type == "jpg" || $type == "jpeg" || $type == "pjpeg")
	{
		// check if less than 2 MB
		if ($size < 2000000)
		{
			// get image width and height
			$data = getimagesize($_FILES["file"]["tmp_name"]);
			$width = $data[0];
			$height = $data[1];

			if ($width <= 250 && $height <= 250)
			{
				require("includes/config.php");

				// set mysterious file name
				$filename = md5(date("YmdHis")).'.jpg';
				$file = $dir . "images/" . $filename;

				// upload
				move_uploaded_file($temp, $file);

				// create avatar url
				$avatar_url = '/' . $file;

				$avatar = '<img src="' . $avatar_url . '" />';

				$sql = "UPDATE users SET avatar = '$avatar' WHERE id = $uid";

				if ($conn->query($sql))
				{
					$array["error"] = "";
					$array["success"] = 1;
				}
				else
				{
					$array["error"] = "Something went wrong. Retry or contact the administrator.";
					$array["success"] = 0;
				}
			}
			else
			{
				$array["error"] = "Width and height must be less than or equal to 250 pixels.";
				$array["success"] = 0;
			}
		}
		else
		{
			$array["error"] = "File size must be less than 2 MB.";
			$array["success"] = 0;
		}
	}
	else
	{
		$array["error"] = "Image must be .png, .gif, .jpg, .jpeg, or .pjpeg format.";
		$array["success"] = 0;
	}

	echo stripslashes(json_encode($array));
?>