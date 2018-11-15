<?php
    $uid = $_GET["id"];
	$uid = make_safe($uid, $conn);

	$sql = "SELECT * FROM users WHERE id = $uid";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{ 
		$row = $result->fetch_assoc(); ?>
		<div class="jumbotron text-center">
			<h1><?= $row["username"] ?></h1>
			<p>Posts: <?= $row["posts"] ?></p>
			<div class="avatar img-thumbnail">
				<?= $row["avatar"] ?>
			</div>
			<p><?= $row["about"] ?></p>
		</div>
<?php	}
	else
	{
		header("Location: /users");
	}
?>