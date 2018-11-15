<?php
    // directory to upload to
	$dir = "uploads/";

	// get file type
	$type = pathinfo($dir . basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);

	// get file size
	$size = $_FILES["file"]["size"];

	// get temp name
	$temp = $_FILES["file"]["tmp_name"];

	// check if valid image extension
	if ($type == "png" || $type == "gif" || $type == "jpg" || $type == "jpeg" || $type == "pjpeg")
	{
		// check if less than 2 MB
		if ($size < 2000000)
		{
			// set mysterious file name
			$filename = md5(date("YmdHis")).'.jpg';
			$file = $dir . "images/" . $filename;

			// upload
			move_uploaded_file($temp, $file);

			$array = array(
				"url" => "/uploads/images/" . $filename
			);

			echo stripslashes(json_encode($array));
		}
	}
	else
	{
		// check if less than 10 MB
		if ($size < 10000000)
		{
			// file name
			$name = $_FILES["file"]["name"];

			// otherwise, upload file to /uploads/files/
			move_uploaded_file($temp, $dir . "files/" . $name);

			$array = array(
				"url" => "/uploads/files/" . $name,
				"name" => $name
			);

			echo stripslashes(json_encode($array));
		}
	}
?>