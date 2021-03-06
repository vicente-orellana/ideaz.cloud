<?php
	include_once("templates/head.php");

	users();
?>
<script>
	$(document).ready(function() {
		$("#main-nav li").each(function() {
			$(this).removeClass("active");
		});

		$("#users").addClass("active");

		// infinite scroll
		// credits goes to SmartTutorials.net
		// http://www.smarttutorials.net/infinite-scroll-using-jquery-ajax-php-and-mysql/

		flag = true;
		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
				first = $("#first").val();
				limit = $("#limit").val();

				no_data = true;

				if (flag && no_data) {
					flag = false;

					$.ajax({
						url: "/templates/ajax/ajax-users.php",
						method: "POST",
						data: {
							start: first,
							limit: limit
						},
						success: function(data) {
							flag = true;

							if (data != '') {
								first = parseInt($("#first").val());
								limit = parseInt($("#limit").val());
								$("#first").val(first + limit);
								$("#users-list").append(data);

							}
							else {
								no_data = false;
							}
						},
						error: function() {
							$("#scroll-posts").html(ajax_load);
						}
					});
				}
			}
		});

	});
</script>
<?php include_once("templates/foot.php"); ?>