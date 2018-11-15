<?php
	// make sql statement safe
	function make_safe($n, $conn)
	{
		$n = $conn->real_escape_string(trim($n));
		return $n;
	}

	// if user is already logged in
	function already_logged_in()
	{
?>
	<div class="text-center">
		<p><h1 class="page-title">You're already logged in!</h1></p>
		<p><a href="logout.php">Click here to log out.</a></p>
	</div>
<?php }

	// login form
	function login_form()
	{ ?>
	<form method="post" name="login" id="login" class="text-center">
		<div class="alert alert-danger gen-error"></div>
		<div class="alert alert-danger username-error"></div>
		<div class="form-group">
			<input name="username" type="text" class="form-control username" placeholder="Username" autocomplete="off" />
		</div>
		<div class="alert alert-danger password-error"></div>
		<div class="form-group">
			<input name="password" type="password" class="form-control password" placeholder="Password" autocomplete="off" />
		</div>
		<button type="button" class="btn btn-primary btn-lg btn-block">
			<i class="glyphicon glyphicon-log-in"></i>&nbsp; Login
		</button>
		<br />
		<p>Don't have an account? <a href="" id="register-link">Click here to create one</a>.</p>
	</form>
<?php }

	// register form
	function register_form()
	{ ?>
	<form method="post" name="register" id="register" class="text-center">
		<div class="alert alert-danger gen-error"></div>
		<div class="alert alert-danger username-error"></div>
		<div class="form-group">
			<input name="username" type="text" class="form-control username" placeholder="Username" autocomplete="off" />
		</div>
		<div class="alert alert-danger password-error"></div>
		<div class="form-group">
			<input name="password" type="password" class="form-control password" placeholder="Password" autocomplete="off" />
		</div>
		<div class="form-group">
			<input name="confirmation" type="password" class="form-control confirmation" placeholder="Confirm Password" autocomplete="off" />
		</div>
		<div class="alert alert-danger email-error"></div>
		<div class="form-group">
			<input name="email" type="email" class="form-control email" placeholder="Email" autocomplete="off" />
		</div>
		<button type="button" class="btn btn-info btn-lg btn-block">
			<i class="glyphicon glyphicon-pencil"></i>&nbsp; Register
		</button>
		<br />
		<p>Already have an account? <a href="" id="login-link">Click here to login</a>.</p>
	</form>
<?php }
	
	// login and register bar
	function user_bar()
	{ ?>
	<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info">
					<?php if (isset($_SESSION["id"])): ?>
						Welcome, <a href="/user.php?id=<?= $_SESSION["id"] ?>"><b><?= $_SESSION["username"] ?></b></a>! (<a href="/user_cp.php">User CP</a> | <a href="/logout.php">Logout</a>)
					<?php else: ?>
							<a href="" data-toggle="modal" data-target="#login-form">Login</a> | <a href="" data-toggle="modal" data-target="#register-form">Register</a>

							<?php include("templates/login-form.php"); ?>
							<?php include("templates/register-form.php"); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
<?php
	}

	// big ideaz
	function big_ideaz()
	{
		require("config.php");

		$sql = "SELECT * FROM users INNER JOIN threads ON threads.user_id = users.id ORDER BY threads.upvotes DESC LIMIT 6";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()): ?>
				<div class="col-md-4">
						<?php
							$thread_title = str_replace(' ', '_', $row["title"]);
							$thread_title = strtolower($thread_title);
						?>
						<a href="thread.php?id=<?= $row["id"] ?>">
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
<?php 		endwhile; ?>

			<!-- for our infinite scroll -->
			<input type="hidden" id="first" value="6" />
			<input type="hidden" id="limit" value="5" />

			<div id="scroll-posts"></div>
<?php
		}
		else
		{
			echo "<h2 class='header-text text-center'>No ideaz</h2>";
		}
	}

	// new ideaz
	function new_ideaz()
	{
		require("config.php");

		$sql = "SELECT * FROM users INNER JOIN threads ON threads.user_id = users.id ORDER BY threads.id DESC LIMIT 6";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc()): ?>
				<div class="col-md-4">
						<?php
							$thread_title = str_replace(' ', '_', $row["title"]);
							$thread_title = strtolower($thread_title);
						?>
						<a href="thread.php?id=<?= $row["id"] ?>">
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
<?php 		endwhile; ?>

			<!-- for our infinite scroll -->
			<input type="hidden" id="first" value="6" />
			<input type="hidden" id="limit" value="10" />

			<div id="scroll-posts"></div>
<?php
		}
		else
		{
			echo "<h2 class='header-text text-center'>No ideaz</h2>";
		}
	}

	function categories()
	{
		require("config.php");

		$letters = range('B', 'Z'); ?>
		
		<div class="row">
			
			<div class="col-xs-12" style="margin-bottom: 15px">

				<div class="row container-fluid">
					<button type="button" class="cat-toggle btn-block navbar-toggle" data-toggle="collapse" data-target="#category-navbar-collapse">A-Z &nbsp; <span class="glyphicon glyphicon-chevron-down"></span></button>
				</div>
				
      			<div class="collapse navbar-collapse" id="category-navbar-collapse">

					<ul id="letters-nav" class="nav nav-pills nav-justified">

						<li class="active"><a data-toggle="tab" href="#A">A</a></li>

						<?php foreach ($letters as $letter): ?>
							<li><a data-toggle="tab" href="#<?= $letter ?>"><?= $letter ?></a></li>		
						<?php endforeach; ?>

					</ul>

				</div>

			</div>

			<div class="col-xs-12">

				<div class="tab-content" id="category-content">

					<div id="A" class="tab-pane fade in active">
					
				<?php
					$sql = "SELECT * FROM categories WHERE title LIKE 'A%' ORDER BY title ASC LIMIT 6";
					$result = $conn->query($sql);
		
					if ($result->num_rows > 0):
						while ($row = $result->fetch_assoc()): ?>
							<a href="/category.php?id=<?= $row["id"] ?>">
								<div class="category">
									<h2><?= str_replace('_', ' ', $row["title"]) ?></h2>
									Ideaz: <?= $row["threads"] ?>
								</div>
							</a>
				<?php  	endwhile; ?>
						
						<!-- for our infinite scroll -->
						<input type="hidden" id="A-first" value="6" />
						<input type="hidden" id="A-limit" value="10" />
						<input type="hidden" id="A-cat" value="A" />
		
						<div class="scroll-posts"></div>
		<?php		else: ?>
						<h2 class="text-center header-text">No Categories</h2>
		<?php		endif; ?>
					</div>
		
		
		<?php	foreach ($letters as $letter): ?>
					<div id="<?= $letter ?>" class="tab-pane fade">
				<?php	$sql = "SELECT * FROM categories WHERE title LIKE '$letter%' ORDER BY title ASC LIMIT 6";
						$result = $conn->query($sql);
		
						if ($result->num_rows > 0):
							while ($row = $result->fetch_assoc()): ?>
								<a href="/category.php?id=<?= $row["id"] ?>">
									<div class="category">
										<h2><?= str_replace('_', ' ', $row["title"]) ?></h2>
											Ideaz: <?= $row["threads"] ?>
									</div>
								</a>
					<?php 	endwhile; ?>
		
							<!-- for our infinite scroll -->
							<input type="hidden" id="<?= $letter ?>-first" value="6" />
							<input type="hidden" id="<?= $letter ?>-limit" value="5" />
							<input type="hidden" id="<?= $letter ?>-cat" value="<?= $letter ?>" />
		
							<div class="scroll-posts"></div>
		
		<?php			else: ?>
							<h2 class="text-center header-text">No Categories</h2>
		<?php			endif; ?>
					</div>
		<?php	endforeach; ?>
		
				</div>
		
			</div>
		
		</div>
<?php	}

	function create_category()
	{ ?>
		<button class="btn btn-info btn-lg btn-block" style="margin-bottom: 20px;" data-toggle="modal" data-target="#create-category">Create New Category</button>

		<!-- Create Category -->
		<div id="create-category" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create New Category</h4>
					</div>

					<div class="modal-body">
						<div class="alert alert-danger"></div>
						<form method="post" id="create">
							<div class="form-group">
								<input type="text" name="title" class="form-control" placeholder="Category Name" id="cat-name" autocomplete="off" />
							</div>
							<button type="submit" class="btn btn-info btn-lg btn-block">Add</button>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php }

	// new thread
	function create_idea($cat_id)
	{ ?>
		<button id="new-idea" class="btn btn-info btn-lg btn-block" style="margin-bottom: 20px;" data-toggle="modal" data-target="#create-idea">New Idea</button>

		<!-- Create Idea -->
		<div id="create-idea" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New Idea</h4>
					</div>

					<div class="modal-body">
						<div id="error" class="alert alert-danger"></div>
						<form method="post" id="create">
							<input type="hidden" name="category_id" value="<?= $cat_id ?>" />
							<div class="form-group">
								<input type="text" name="title" class="form-control" id="idea-title" placeholder="Idea Title" autocomplete="off" />
							</div>
							<div class="form-group">
								<textarea id="textbox" name="body"></textarea>
							</div>
							<button type="button" class="btn btn-info btn-lg btn-block" id="submit-btn">Post</button>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php }

	function post_textbox($thread_id)
	{ ?>
		<div id="post-textbox">
	  		<div class="alert alert-danger"></div>
	  		<form action="thread.php" method="post" id="thread-post">
	  			<input type="hidden" name="thread_id" value="<?= $thread_id ?>" />
	  			<textarea name="body" id="textbox"></textarea>
	  			<button id="submit-btn" class="btn btn-primary btn-lg btn-block btn-textbox">Post</button>
	  		</form>
	  	</div>
<?php }

	function nav_bar()
	{ ?>
		<div class="col-xs-12" style="margin-bottom: 20px;">
		 	<ul class="nav nav-pills nav-justified" id="main-nav">
			    <li id="big-ideaz" class="active"><a href="/" id="bi">Big Ideaz</a></li>
			    <li id="new-ideaz"><a href="/new_ideaz.php" id="ni">New Ideaz</a></li>
			    <li id="categories"><a href="/categories.php" id="cats">Categories</a></li>
			    <li id="users"><a href="/users.php" id="ur">Users</a></li>
		  	</ul>
	  	</div>
<?php }

	function users()
	{
		require("config.php");

		$sql = "SELECT * FROM users ORDER BY username ASC LIMIT 15";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			echo "<div class='row col-xs-12'>";
			echo "<ul id='users-list'>";
			while ($row = $result->fetch_assoc()): 
				$uid = make_safe($row["id"], $conn); ?>
				<a href="/user.php?id=<?= $uid ?>">
					<li>
						<p><?= $row["avatar"] ?></p>
						<p><?= $row["username"] ?></p>
					</li>
				</a>
<?php
			endwhile; ?>

			<!-- for our infinite scroll -->
			<input type="hidden" id="first" value="15" />
			<input type="hidden" id="limit" value="10" />
		
<?php		echo "</ul>";

			echo "</div>";
		}
	}
?>