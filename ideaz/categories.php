<?php include_once("templates/head.php"); ?>
	<div id="content">
		<?php
			if (isset($_SESSION["id"]))
			{
				create_category();
			}
		?>

  		<?php categories(); ?>
	</div>
	
<script>
	$(document).ready(function() {
		// change pill on navbar
		$("#main-nav li").each(function() {
			$(this).removeClass("active");
		});

		$("#categories").addClass("active");

		$(".alert.alert-danger").hide();

		// create category
		$("#create").submit(function(e) {
			e.preventDefault();
			
			// check if empty
			if ($("#cat-name").val() == "") {
				$(".alert.alert-danger").html("Please enter a category name.").fadeIn("slow").delay(2000).fadeOut("slow");
				return false;
			}
			else {
				$.ajax({
					url: "/addcat.php",
					type: "POST",
					dataType: "json",
					data: $("#create").serialize(),
					success: function(data) {
						// check if error
						if (data.error != "") {
							$(".alert.alert-danger").html(data.error).fadeIn("slow").delay(2000).fadeOut("slow");
							return false;
						}
						else {
							window.location.reload(true);
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
								$(".col-xs-11").load($(location).attr("href") + " #category-content");
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

		$(".nav.nav-pills").click(function() {
			$(".scroll-posts").html("");

			// each time a new pill is clicked, initialize first and limit
			$("#" + $(".tab-pane.active").attr("id") + "-first").val(7);
			$("#" + $(".tab-pane.active").attr("id") + "-limit").val(10);

			flag = true;
			$(window).scroll(function() {
				if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
					first = $("#" + $(".tab-pane.active").attr("id") + "-first").val();
					limit = $("#" + $(".tab-pane.active").attr("id") + "-limit").val();
					cat_id = $(".tab-pane.active").attr("id");

					no_data = true;

					if (flag && no_data) {
						flag = false;

						$.ajax({
							url: "/templates/ajax/ajax-categories.php",
							method: "POST",
							data: {
								start: first,
								limit: limit,
								cat_id: cat_id
							},
							success: function(data) {
								flag = true;

								if (data != '') {
									first = parseInt($("#" + $(".tab-pane.active").attr("id") + "-first").val());
									limit = parseInt($("#" + $(".tab-pane.active").attr("id") + "-limit").val());
									$("#" + $(".tab-pane.active").attr("id") + "-first").val(first + limit);
									$(".scroll-posts").append(data);

								}
								else {
									no_data = false;
								}
							},
							error: function() {
								$(".scroll-posts").html(ajax_load);
							}
						});
					}
				}
			});
		});

		// default
		flag = true;
		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
				first = $("#" + $(".tab-pane.active").attr("id") + "-first").val();
				limit = $("#" + $(".tab-pane.active").attr("id") + "-limit").val();
				cat_id = $(".tab-pane.active").attr("id");

				no_data = true;

				if (flag && no_data) {
					flag = false;

					$.ajax({
						url: "/templates/ajax/ajax-categories.php",
						method: "POST",
						data: {
							start: first,
							limit: limit,
							cat_id: cat_id
						},
						success: function(data) {
							flag = true;

							if (data != '') {
								first = parseInt($("#" + $(".tab-pane.active").attr("id") + "-first").val());
								limit = parseInt($("#" + $(".tab-pane.active").attr("id") + "-limit").val());
								$("#" + $(".tab-pane.active").attr("id") + "-first").val(first + limit);
								$(".scroll-posts").append(data);

							}
							else {
								no_data = false;
							}
						},
						error: function() {
							$(".scroll-posts").html(ajax_load);
						}
					});
				}
			}
		});
	});
</script>
<?php include_once("templates/foot.php"); ?>