// remove thread
$("#remove-thread").click(function() {
	if (confirm("Are you sure you want to remove this idea?")) {
		thread_id = $("#remove-thread #remove-thread-id").val();

		$.ajax({
			url: "/remove.php",
			type: "POST",
			data: {
				thread_id: thread_id
			},
			success: function() {
				window.location.replace("/");
			}
		});
	}
});

// remove post
$(".remove-post").click(function() {
	if (confirm("Are you sure you want to remove this post?")) {
		post_id = $(".remove-post-id").val();

		$.ajax({
			url: "/remove.php",
			type: "POST",
			data: {
				post_id: post_id
			},
			success: function() {
				location.reload();
			}
		})
	}
});