<?php include_once("templates/head.php"); ?>
	<div id="content">
  		<?php new_ideaz(); ?>
	</div>
<script>
	$(document).ready(function() {
		// change pill on navbar
		$("#main-nav li").each(function() {
			$(this).removeClass("active");
		});

		$("#new-ideaz").addClass("active");

		// get current page url
		var page_url = $(location).attr("href");

		// old data for checking
		var old_data;

		// get new data from site
		$.ajax({
			url: page_url,
			type: "GET",
			success: function(data) {
				old_data = data;
			},
			complete: function() {
				setInterval(function() {
					$.ajax({
						url: page_url,
						type: "GET",
						cache: false,
						success: function(new_data) {
							if (new_data != old_data) {
								window.location.reload();
								old_data = new_data;
							}
						}
					});
				}, 5000);
			}
		});

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
						url: "/templates/ajax/ajax-newideaz.php",
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
								$("#scroll-posts").append(data);

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