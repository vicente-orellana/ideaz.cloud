// hide error box
$(".alert.alert-danger").hide();

// textbox
$("#submit-btn").click(function(e) {
	e.preventDefault();

	if ($("#textbox").val() == "") {
		$(".alert.alert-danger").html("Please enter some text.").fadeIn("slow").delay(2000).fadeOut("slow");
		return false;
	}
	else {
		$(".alert.alert-danger").hide();
		$.ajax({
			url: $(document).attr("href"),
			type: "POST",
			data: $("#thread-post").serialize(),
			success: function() {
				$(".redactor-editor").html("");
			}
		});
	}
});