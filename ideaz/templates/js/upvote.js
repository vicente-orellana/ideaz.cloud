// upvote
$(".lightbulb").click(function(e) {
	e.preventDefault();

	$.post("/upvote.php", $("#upvote").serialize(), function() {
		$.ajax({
			url: $(location).attr("href"),
			type: "GET",
			success: function(data) {
				$("#vote-section").html($(data).find("#vote-section"));
				$.getScript("/templates/js/upvote.js");
			}
		});
	});
});