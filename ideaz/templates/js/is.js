// infinite scroll
// credits goes to SmartTutorials.net
// http://www.smarttutorials.net/infinite-scroll-using-jquery-ajax-php-and-mysql/

flag = true;
$(window).scroll(function() {
	if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
		first = $("#first").val();
		limit = $("#limit").val();
		thread_id = $("#thread_id").val();

		no_data = true;

		if (flag && no_data) {
			flag = false;

			$.ajax({
				url: "/templates/ajax/ajax.php",
				method: "POST",
				data: {
					start: first,
					limit: limit,
					thread_id: thread_id
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