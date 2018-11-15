// edit thread
$("#edit-thread").click(function(e) {
	e.preventDefault();

	// hide current thread body
	$("#thread-body + div").hide();

	// get current text
	current_body = $("#thread-body-hidden").val();

	// create textarea with current text
	$("#thread-body").html("<textarea id='thread-edit-body'>" + current_body + "</textarea><button id='edit-btn' class='btn btn-primary btn-lg btn-block'><i class='glyphicon glyphicon-pencil'></i> Edit</button>");

	// upon clicking edit button
	$("#edit-btn").click(function(e) {
		e.preventDefault();

		new_html = $("#thread-edit-body").val();
		thread_id = $("#edit-thread-id").val();

		// edit thread
		$.ajax({
			url: "/edit.php",
			type: "POST",
			data: {
				is_thread: 1,
				new_data: new_html,
				thread_id: thread_id
			},
			success: function(data) {
				location.reload();
			}
		});

	});

	// rich text editor
	$("#thread-edit-body").redactor({
		minHeight: 150,
		placeholder: "Your thoughts?",
		toolbarFixed: true,
		toolbarFixedTarget: '#thread-edit-body',
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
});

// edit post
$(".edit-post").click(function(e) {
	e.preventDefault();

	// get post id
	post_id = $(this).find(".edit-post-id").val();

	// hide current text
	$("#post-" + post_id + " + div").hide();

	// get current body html
	current_body = $("#" + post_id + "-post-body-hidden").val();

	// create edit textbox
	$("#post-" + post_id).html("<br /><textarea id='" + post_id + "-post-edit-body'>" + current_body + "</textarea><button id='" + post_id + "-edit-btn' class='btn btn-primary btn-lg btn-block'><i class='glyphicon glyphicon-pencil'></i> Edit</button>");

	// upon clicking edit button
	$("#" + post_id + "-edit-btn").click(function(e) {
		e.preventDefault();

		new_html = $("#" + post_id + "-post-edit-body").val();

		// edit post
		$.ajax({
			url: "/edit.php",
			type: "POST",
			data: {
				is_post: 1,
				new_data: new_html,
				post_id: post_id
			}
		});

	});

	// rich text editor
	$("#" + post_id + "-post-edit-body").redactor({
		minHeight: 150,
		placeholder: "Your thoughts?",
		toolbarFixed: true,
		toolbarFixedTarget: "#" + post_id + "-post-edit-body",
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
});