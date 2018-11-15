<?php
	$thread_id = make_safe($_GET["id"], $conn);

	$sql = "SELECT * FROM threads INNER JOIN users ON threads.user_id = users.id WHERE threads.id = $thread_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0):
		$result = $result->fetch_assoc();

		// for checking if user can edit/remove posts
		$thread_uid = $result["user_id"];

		$cat = "SELECT title FROM categories WHERE id = $result[category_id]";
		$cat_result = $conn->query($cat);
		$cat_row = $cat_result->fetch_assoc(); ?>

		<ol class="breadcrumb">
		  <li><a href="/categories.php">categories</a></li>
		  <li><a href="/category.php?id=<?= make_safe($result["category_id"], $conn) ?>"><?= strtolower(str_replace('_', ' ', $cat_row["title"])) ?></a></li>
		  <li class="active"><?= strtolower($result["title"]) ?></li>
		</ol>

		<div class="discussion">

			<div id="vote-section">

			<?php
				$user_id = $_SESSION["id"];

				if (isset($_SESSION["id"]))
				{
					// users who have voted
					$voted_users = explode(" ", $result["vote_users"]);

					// check if user voted
					$user_voted = array_search($user_id, $voted_users);

					if ($user_voted !== false): ?>
						
						<form action="/upvote.php" id="upvote">
							<input type="hidden" value="0" name="upvote" />
							<input type="hidden" value=" <?= $user_id ?> " name="user_id" />
							<input type="hidden" value="<?= $thread_id ?>" name="thread_id" />
							<div class="upvote">
								<a class="lightbulb">
									<i class="fa fa-lightbulb-o upvoted"></i>
								</a>
							</div>
						</form>

			<?php	else: ?>
						<form action="/upvote.php" id="upvote">
							<input type="hidden" value="1" name="upvote" />
							<input type="hidden" value=" <?= $user_id ?> " name="user_id" />
							<input type="hidden" value="<?= $thread_id ?>" name="thread_id" />
							<div class="upvote">
								<a class="lightbulb">
									<i class="fa fa-lightbulb-o"></i>
								</a>
							</div>
						</form>
			<?php	endif;
				}
			?>
			</div>

				<?php if ($_SESSION["is_admin"] || $thread_uid == $_SESSION["id"]): ?>
					<div class="text-right">
						<button id="edit-thread" class="btn btn-xs btn-success">
							<input type="hidden" id="edit-thread-id" value="<?= $thread_id ?>" />
							<i class="glyphicon glyphicon-pencil"></i>
						</button>

						<button id="remove-thread" class="btn btn-xs btn-danger">
							<input type="hidden" id="remove-thread-id" value="<?= $thread_id ?>" />
							<i class="glyphicon glyphicon-remove"></i>
						</button>
					</div>
				<?php endif; ?>

				<div class="page-header text-center">
					<h3><?= $result["title"] ?></h3>
				</div>
				<input type="hidden" id="thread-body-hidden" value='<?= $result["body"] ?>' />
				<p id="thread-body"><div><?= $result["body"] ?></div></p>
		</div>
		<div><a href="/user.php?id=<?= make_safe($result["id"], $conn) ?>"><?= $result["username"] ?><?= $result["avatar"] ?></a></div>

		<?php if (isset($_SESSION["id"])): ?>

	  		<?php post_textbox($thread_id); ?>
	  		
		<?php endif; ?>

		<div id="posts">

			<div id="first-posts">
			<?php
				// display the first 5 posts
				$sql = "SELECT * FROM posts WHERE thread_id = $thread_id ORDER BY id DESC LIMIT 5";
				$result = $conn->query($sql);
				$rowcount = $result->num_rows;

				if ($rowcount > 0):

					while ($row = $result->fetch_assoc()):
						// get user info
						$uid = $row["user_id"];
						$user_sql = "SELECT * FROM users WHERE id = $uid";
						$user_result = $conn->query($user_sql);
						$user_row = $user_result->fetch_assoc();
					?>

						<div class="discussion">
							
							<?php if ($_SESSION["is_admin"] || $uid == $_SESSION["id"]): ?>
								<div class="text-right">
									<button class="edit-post btn btn-xs btn-success">
										<input type="hidden" class="edit-post-id" value="<?= $row["id"] ?>" />
										<i class="glyphicon glyphicon-pencil"></i>
									</button>

									<button class="remove-post btn btn-xs btn-danger">
										<input type="hidden" class="remove-post-id" value="<?= $row["id"] ?>" />
										<i class="glyphicon glyphicon-remove"></i>
									</button>
								</div>
							<?php endif; ?>

							<input type="hidden" id="<?= $row[id] ?>-post-body-hidden" value='<?= $row["body"] ?>' />
							<p id="post-<?= $row[id] ?>"><div><?= $row["body"] ?></div></p>
						</div>
						<div><a href="/user.php?id=<?= make_safe($uid, $conn) ?>"><?= $user_row["username"] ?><?= $user_row["avatar"] ?></a></div>

		<?php 		endwhile;
				endif;
		?>
			</div>

			<!-- for our infinite scroll -->
			<input type="hidden" id="first" value="5" />
			<input type="hidden" id="limit" value="10" />
			<input type="hidden" id="thread_id" value="<?= $thread_id ?>" />

			<div id="scroll-posts"></div>

		</div>
<?php
	else:
		header("Location: /");
  	endif;
?>