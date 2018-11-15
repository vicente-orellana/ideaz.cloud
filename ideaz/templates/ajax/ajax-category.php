<?php
	require(__DIR__ . "/../../includes/config.php");
	include_once(__DIR__ . "/../../includes/functions.php");

	$start = make_safe($_POST["start"], $conn);
	$limit = make_safe($_POST["limit"], $conn);
	$cat_id = make_safe($_POST["cat_id"], $conn);

	// get rows
	if (!empty($start) && !empty($limit) && !empty($cat_id))
	{
		$sql = "SELECT * FROM users INNER JOIN threads ON users.id = threads.user_id WHERE category_id = $cat_id ORDER BY threads.title ASC LIMIT $start, $limit";
		$result = $conn->query($sql);
		$data = array();
		$rowcount = $result->num_rows;
		$data["count"] = $rowcount;

		if ($rowcount > 0):

			while ($row = $result->fetch_assoc()): ?>

				<div class="col-md-4">
						<?php
							$thread_title = str_replace(' ', '_', $row["title"]);
							$thread_title = strtolower($thread_title);
						?>
						<a href="thread.php?id=<?= make_safe($row["id"], $conn) ?>">
							<div class="fa fa-cloud cloud-thread">
								<div class="cloud-thread-info">
									<div class="cloud-upvotes"><i class="fa fa-lightbulb-o"></i> <?= $row["upvotes"] ?></div>
									<div class="cloud-title"><?= $row["title"] ?></div>
									<div class="cloud-sub">
										<p class="user"><i class="glyphicon glyphicon-user"></i> <?= $row["username"] ?></p>
										<p class="posts"><i class="fa fa-comments"></i> <?= $row["posts"] ?></p>
									</div>
								</div>
							</div>
						</a>
				</div>

<?php 		endwhile;
		endif;
	}
?>