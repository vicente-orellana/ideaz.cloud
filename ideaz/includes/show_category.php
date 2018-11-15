<?php
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
    	$cat_id = make_safe($_GET["id"], $conn);
    
    	// check if valid category
    	$sql = "SELECT * FROM categories WHERE id = $cat_id";
    	$result = $conn->query($sql);
    
    	if ($result->num_rows > 0)
    	{
    		$row = $result->fetch_assoc(); ?>
    
    		<ol class="breadcrumb text-center">
    		  <li><a href="/categories.php">categories</a></li>
    		  <li class="active"><?= str_replace('_', ' ', $row["title"]) ?></li>
    		</ol>
    
    <?php		if (isset($_SESSION["id"]))
    		{
    			create_idea($cat_id);
    		}
    
    		// find threads in category
    		$sql = "SELECT * FROM users INNER JOIN threads ON users.id = threads.user_id WHERE category_id = $cat_id ORDER BY threads.upvotes DESC LIMIT 6";
    		$result = $conn->query($sql);
    
    		if ($result->num_rows > 0)
    		{
    			while ($row = $result->fetch_assoc()): ?>
    				<div class="col-md-4">
    						<?php
    							$thread_title = str_replace(' ', '_', $row["title"]);
    							$thread_title = strtolower($thread_title);
    						?>
    						<a href="/thread.php?id=<?= make_safe($row["id"], $conn) ?>">
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
    <?php 	endwhile; ?>
    				<!-- for our infinite scroll -->
    				<input type="hidden" id="first" value="6" />
    				<input type="hidden" id="limit" value="5" />
    				<input type="hidden" id="cat_id" value="<?= $cat_id ?>" />
    
    				<div id="scroll-posts"></div>
    <?php		}
    		else
    		{
    			echo '<h2 class="header-text text-center">No ideaz yet</h2>';
    		}
    	}
    	else
    	{
    		header("Location: /categories");
    	}
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
    	// get thread info
    	$title = make_safe($_POST["title"], $conn);
    	$body = $_POST["body"];
    	$user_id = $_SESSION["id"];
    	$category_id = $_POST["category_id"];
    
    	// create json array
    	$array = array();
    
    	// check if user is logged in
    	if (isset($_SESSION["id"]))
    	{
    		if (!empty($title) && !empty($body))
    		{
    			$sql = "INSERT INTO threads (title, body, user_id, category_id) VALUES ('$title', '$body', $user_id, $category_id)";
    
    			if ($conn->query($sql) === TRUE)
    			{
    				$sql = "UPDATE categories SET threads = threads + 1 WHERE id = $category_id;";
    				$sql .= "UPDATE users SET posts = posts + 1 WHERE id = $user_id;";
    				$conn->multi_query($sql);
    
    				$array["error"] = "";
    			}
    		}
    		else
    		{
    			$array["error"] = "Unable to post idea.";
    		}
    
    		echo json_encode($array);
    	}
    	else
    	{
    		header("Location: /categories");
    	}
    }
?>