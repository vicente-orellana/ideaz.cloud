// keep thread url
var thread_url = $(location).attr("href");

// initialize variable to store old data for updates
var old_data;

// get new data from site
$.ajax({
	url: thread_url,
	type: "GET",
	success: function(data) {
		old_data = data;
	},
	complete: function() {
		setInterval(function() {
			$.ajax({
				url: thread_url,
				type: "GET",
				success: function(new_data) {
					if (new_data != old_data) {
						$("#posts").html(ajax_load).delay(1000).load(document.URL + " #posts");

						$.getScript("/templates/js/edit.js");
						$.getScript("/templates/js/remove.js");
						
						old_data = new_data;
					}
				}
			});
		}, 2000);
	}
});