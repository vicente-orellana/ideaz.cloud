<?php
    $user_id = $_SESSION["id"];
	$sql = "SELECT * FROM users WHERE id = $user_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while ($row = $result->fetch_assoc())
		{ ?>

			<div class="row">
				<div class="col-xs-12">
					<div class="jumbotron text-center">
						<h1>User CP</h1>
						<p>Welcome, <?= $_SESSION["username"] ?>!</p>

						<form id="update-profile" method="post">
							<input type="hidden" name="user_id" value="<?= $user_id ?>" />
							<div class="form-group">
								<label>About Me (optional)</label>
								<div class="alert alert-success" id="about-success"></div>
								<div class="alert alert-danger" id="about-error"></div>
								<textarea id="about-me" name="about-me"><?php if (!empty($row["about"])) { echo $row["about"]; } ?></textarea>
							</div>
							<div class="form-group">
								<label>Change Password (optional)</label>
								<div class="alert alert-success" id="pw-success"></div>
								<div class="alert alert-danger" id="pw-error"></div>
								<input class="form-control" type="password" id="curr" name="curr" placeholder="Current Password" />
							</div>
							<div class="form-group">
								<input class="form-control" type="password" id="new" name="new" placeholder="New Password" />
							</div>
							<div class="form-group">
								<input class="form-control" type="password" id="new_c" name="new_c" placeholder="Confirm New Password" />
							</div>
							<div class="form-group">
								<label>Change Email (optional)</label>
								<div class="alert alert-success" id="email-success"></div>
								<div class="alert alert-danger" id="email-error"></div>
								<input class="form-control" id="email" type="email" name="email" value="<?= $row["email"] ?>" />
							</div>
							
							<button class="btn btn-primary btn-lg btn-block"><i class="glyphicon glyphicon-edit"></i>&nbsp; Update Profile</button>
						</form>

						<hr />

						<div class="form-group">
							<label>Change Avatar (max: 250 x 250 pixels)</label><br />

							<div class="avatar img-thumbnail" id="current_avatar"><?= $row["avatar"] ?></div>
						</div>

						<div class="alert alert-success" id="avatar-success"></div>
						<div class="alert alert-danger" id="avatar-error"></div>

						<form id="avatar-upload" action="/avatar-upload.php" class="dropzone"></form>
					</div>
				</div>
			</div>
<?php
		}
	}
	else
	{
		header("Location: /");
	}
?>