<?php
	require(__DIR__ . "/../../includes/config.php");
	include_once(__DIR__ . "/../../includes/functions.php");

	$start = make_safe($_POST["start"], $conn);
	$limit = make_safe($_POST["limit"], $conn);
	$cat_id = make_safe($_POST["cat_id"], $conn);

	// get rows
	if (!empty($start) && !empty($limit) && !empty($cat_id))
	{
		$sql = "SELECT * FROM categories WHERE title LIKE '$cat_id%' ORDER BY title ASC LIMIT $start, $limit";
		$result = $conn->query($sql);
		$data = array();
		$rowcount = $result->num_rows;
		$data["count"] = $rowcount;

		if ($rowcount > 0):

			while ($row = $result->fetch_assoc()):
				echo '<a href="/category.php?id=' . $row["id"] . '">';
				echo '<div class="category">';
				echo '<h2>' . str_replace('_', ' ', $row["title"]) . "</h2>";
				echo "Ideaz: " . $row["threads"];
				echo '</div>';
				echo '</a>';
			endwhile;
		endif;
	}
?>