<?php
	include_once("templates/head.php");

	include("includes/show_category.php");
?>

<script>
	$(document).ready(function() {
		$("#main-nav li").each(function() {
			$(this).removeClass("active");
		});

		$("#categories").addClass("active");

		$("#textarea").redactor();

		$("#error").hide();

		$("#create .btn").click(function() {
			if ($("#idea-title").val() == "") {
				$("#error").html("Please enter a title.").fadeIn("slow").delay(2000).fadeOut("slow");
				return false;
			}
			else if ($("#textbox").val() == "") {
				$("#error").html("Please enter some text.").fadeIn("slow").delay(2000).fadeOut("slow");
				return false;
			}
			else {
				$.ajax({
					url: $(location).attr("href"),
					type: "POST",
					dataType: "json",
					data: $("#create").serialize(),
					success: function(data) {
						if (data.error != "") {
							$("#error").html(data.error).fadeIn("slow").delay(2000).fadeOut("slow");
							return false;
						}
						else {
							window.location.reload("true");
							return true;
						}
					}
				});
			}
		});

		// get current page url
		var page_url = $(location).attr("href");

		// old data for checking
		var old_data;

		// get new data from site
		$.ajax({
			url: page_url,
			type: "GET",
			cache: false,
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
								location.reload();
								old_data = new_data;
							}
						}
					});
				}, 2000);
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
				cat_id = $("#cat_id").val();

				no_data = true;

				if (flag && no_data) {
					flag = false;

					$.ajax({
						url: "/templates/ajax/ajax-category.php",
						method: "POST",
						data: {
							start: first,
							limit: limit,
							cat_id: cat_id
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