<?php
	include_once("templates/head.php");

	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		include("templates/user_profile.php");
	}
	else
	{
		header("Location: /users");	
	}
?>
<script>
	$(document).ready(function() {
		$("#main-nav li").each(function() {
			$(this).removeClass("active");
		});

		$("#users").addClass("active");
	});
</script>
<?php include_once("templates/foot.php"); ?>