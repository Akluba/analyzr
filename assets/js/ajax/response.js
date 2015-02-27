$("#survey_response").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var data = $(this).serialize();

	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "get_response",
		dataType: 'json',
		data: data,
		success: function(res) {
			console.log(res);
		}// end success
	});// end ajax post
});// end submit()