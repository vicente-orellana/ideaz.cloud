// initialize errors
$(".username-error").hide();
$(".password-error").hide();
$(".email-error").hide();
$(".alert.alert-danger.gen-error").hide();

// login -> register form
$("#login-form #register-link").click(function(e) {
	e.preventDefault();
	$("#login-form").modal('hide');
	$("#register-form").modal('show');
});

// register -> login form
$("#register-form #login-link").click(function(e) {
	e.preventDefault();
	$("#register-form").modal('hide');
	$("#login-form").modal('show');
});

// login form
$("#login .btn").click(function() {
	if ($("#login .username").val() == "") {
		$("#login .username-error").html("Please enter your username.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else if ($("#login .password").val() == "") {
		$("#login .password-error").fadeIn();
		$("#login .password-error").html("Please enter your password.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else {
		$("#login .username-error").fadeOut();
		$("#login .password-error").fadeOut();

		$.ajax({
			url: "/login.php",
			type: "POST",
			dataType: "json",
			data: $("#login").serialize(),
			success: function(data) {
				if (data.error != "") {
					$("#login .alert.alert-danger.gen-error").html(data.error).fadeIn("slow").delay(3000).fadeOut("slow");
					return false;
				} else {
					window.location.reload(true);
					return true;
				}
			}
		});
	}
});

// register form
$("#register .btn").click(function() {
	if ($("#register .username").val() == "") {
		$("#register .username-error").html("Please enter a username.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else if ($("#register .password").val() == "") {
		$("#register .password-error").html("Please enter a password.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else if ($("#register .confirmation").val() == "") {
		$("#register .password-error").html("Please confirm your password.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else if ($("#register .password").val() != $("#register .confirmation").val()) {
		$("#register .password-error").html("Please ensure your passwords match.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else if ($("#register .email").val() == "") {
		$("#register .email-error").html("Please enter your email.").fadeIn("slow").delay(3000).fadeOut("slow");
		return false;
	}
	else {
		$("#register .username-error").hide();
		$("#register .password-error").hide();
		$("#register .email-error").hide();
		$("#register .alert.alert-danger.gen-error").hide();

		$.ajax({
			url: "/register.php",
			type: "POST",
			dataType: "json",
			data: $("#register").serialize(),
			success: function(data) {
				if (data.error != "") {
					$(".alert.alert-danger.gen-error").html(data.error).fadeIn("slow").delay(3000).fadeOut("slow");
					return false;
				} else {
					window.location.reload(true);
					return true;
				}
			}
		});
	}
});