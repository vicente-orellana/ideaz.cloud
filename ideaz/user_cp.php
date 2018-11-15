<?php
	include_once("templates/head.php");

	if (isset($_SESSION["id"]))
	{
		include("templates/user_cp.php");
	}
	else
	{
		header("Location: /");
	}
?>
<script>
	$(document).ready(function() {
		// set up redactor text editor
		$("#about-me").redactor({
			minHeight: 150,
			placeholder: "Your thoughts?",
			toolbarFixed: true,
			toolbarFixedTarget: '#update-profile',
			imageUpload: '/upload.php',
			fileUpload: '/upload.php',
			formattingAdd: {
			  "align-left": {
			    "title": "Align Left",
			    "args": ["p","class","align-left"],
			  },
			  "align-right": {
			    "title": "Align Right",
			    "args": ["p","class","align-right"],
			  },
			  "align-center": {
			    "title": "Align Center",
			    "args": ["p","class","align-center"],
			  },
			},
		});

		// hide errors
		$(".alert.alert-danger").hide();
		$(".alert.alert-success").hide();

		// set up dropzone
		Dropzone.options.avatarUpload = {
			uploadMultiple: false,
			maxFiles: 1,
			dictDefaultMessage: "Drag and drop an image here or click to upload.<br />(.jpg, .jpeg, .gif, .png, .pjpeg)",
			success: function(file, data) {
				var obj = $.parseJSON(data);

				if (obj.error != "") {
					$("#avatar-error").html(obj.error).fadeIn("slow").delay(5000).fadeOut("slow");
					this.removeAllFiles();
				} else {
					$("#avatar-success").html("Avatar successfully changed.").fadeIn("slow").delay(3000).fadeOut("slow");
					this.removeAllFiles();
					$.ajax({
						url: $(location).attr("href"),
						data: "GET",
						cache: false,
						success: function() {
							$("#current_avatar").html(ajax_load).delay(2000).load($(location).attr("href") + " #current_avatar");
						}
					});
				}
			}
		}

		// update profile
		$("#update-profile").submit(function(e) {
			e.preventDefault();

			// check about me
			if ($("#about-me").val() != "")	{
				$.ajax({
					url: "/update.php",
					type: "POST",
					data: $("#update-profile").serialize(),
					dataType: "json",
					success: function(data) {
						$("#about-success").html("Successfully updated about me.").fadeIn("slow").delay(5000).fadeOut("slow");
					}
				});
			}

			// check passwords
			if ($("#curr").val() != "" || $("#new").val() != "" || $("#new_c").val() != "") {
				if ($("#curr").val() == "" || $("#new").val() == "" || $("#new_c").val() == "") {
					$("#pw-error").html("If changing your password, please fill out all of the required fields.").fadeIn("slow").delay(5000).fadeOut("slow");
				}
				else if ($("#curr").val() == $("#new").val()) {
					$("#pw-error").html("Current password and new password cannot be the same.").fadeIn("slow").delay(5000).fadeOut("slow");
				}
				else if ($("#new").val() != $("#new_c").val()) {
					$("#pw-error").html("New password and confirmation do not match.").fadeIn("slow").delay(5000).fadeOut("slow");
				}
				else {
					$.ajax({
						url: "/update.php",
						type: "POST",
						data: $("#update-profile").serialize(),
						dataType: "json",
						success: function(data) {
							if (data.password_error != "") {
								$("#pw-error").html(data.password_error).fadeIn("slow").delay(5000).fadeOut("slow");
							}
							else {
								$("#pw-success").html("Successfully updated password.").fadeIn("slow").delay(5000).fadeOut("slow");
							}
						}
					});
				}
			}

			// check email
			if ($("#email").val() != "") {
				$.ajax({
					url: "/update.php",
					type: "POST",
					data: $("#update-profile").serialize(),
					dataType: "json",
					success: function(data) {
						if (data.email_error != "") {
							$("#email-error").html(data.email_error).fadeIn("slow").delay(5000).fadeOut("slow");
						}
						else {
							$("#email-success").html("Successfully updated email.").fadeIn("slow").delay(5000).fadeOut("slow");
						}
					}
				});
			} else {
				$("#email-error").html("Please enter an email.").fadeIn("slow").delay(5000).fadeOut("slow");
			}

		});
	});
</script>
<?php
	include_once("templates/foot.php");
?>