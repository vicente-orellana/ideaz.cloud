<?php include_once("templates/head.php"); ?>

	<div id="content">

  		<?php
			if ($_SERVER["REQUEST_METHOD"] == "GET")
			{
				include("includes/thread_view.php");
			}
			else if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				include("includes/thread_post.php");
			}
			else
			{
				header("Location: /");
			}
		?>

	</div>
<script src="/templates/js/edit.js"></script>
<script src="/templates/js/remove.js"></script>
<script src="/templates/js/upvote.js"></script>
<script src="/templates/js/textbox.js"></script>
<script src="/templates/js/thread-update.js"></script>
<script src="/templates/js/is.js"></script>
<?php include_once("templates/foot.php"); ?>