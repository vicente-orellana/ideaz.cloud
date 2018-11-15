<?php
	require(__DIR__ . "/../../includes/config.php");
	include_once(__DIR__ . "/../../includes/functions.php");

	$start = make_safe($_POST["start"], $conn);
	$limit = make_safe($_POST["limit"], $conn);
	$thread = make_safe($_POST["thread_id"], $conn);

	// get rows
	if (!empty($start) && !empty($limit) && !empty($thread))
	{
		$sql = "SELECT * FROM posts WHERE thread_id = $thread ORDER BY id DESC LIMIT $start, $limit";
		$result = $conn->query($sql);
		$data = array();
		$rowcount = $result->num_rows;
		$data["count"] = $rowcount;

		if ($rowcount > 0):

			while ($row = $result->fetch_assoc()):
				$uid = $row["user_id"];
				$user_sql = "SELECT * FROM users WHERE id = $uid";
				$user_result = $conn->query($user_sql);
				$user_row = $user_result->fetch_assoc();
			?>

				<div class="discussion">
										
					<?php if ($_SESSION["is_admin"]): ?>
						<div class="text-right">
							<button class="remove-post btn btn-xs btn-danger">
								<input type="hidden" class="remove-post-id" value="<?= $row["id"] ?>" />
								<i class="glyphicon glyphicon-remove"></i>
							</button>
						</div>
					<?php endif; ?>

					<p class="text-left"><?= $row["body"] ?></p>
				</div>
				<div><a href="/user.php?id=<?= make_safe($user_row["id"], $conn) ?>"><?= $user_row["username"] ?><?= $user_row["avatar"] ?></a></div>

<?php 		endwhile;
		endif;
	}
?>