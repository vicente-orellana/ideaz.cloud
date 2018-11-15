<?php
	require(__DIR__ . "/../../includes/config.php");
	include_once(__DIR__ . "/../../includes/functions.php");

	$start = make_safe($_POST["start"], $conn);
	$limit = make_safe($_POST["limit"], $conn);

	// get rows
	if (!empty($start) && !empty($limit))
	{
		$sql = "SELECT * FROM users ORDER BY username ASC LIMIT $start, $limit";
		$result = $conn->query($sql);
		$data = array();
		$rowcount = $result->num_rows;
		$data["count"] = $rowcount;

		if ($rowcount > 0):

			while ($row = $result->fetch_assoc()): ?>
				<a href="/user.php?id=<?= make_safe($row["id"], $conn) ?>">
					<li>
						<p><?= $row["avatar"] ?></p>
						<p><?= $row["username"] ?></p>
					</li>
				</a>
<?php		endwhile;
		endif;
	}
?>