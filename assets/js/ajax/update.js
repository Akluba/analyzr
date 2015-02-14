/* UPDATE TITLE
	-INCLUDES-
	
*/
$("#title_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var form = document.getElementById("title_form");
	// object to contain data
	data = {}
	// extract element name : value
	for(var i = 0; i < form.elements.length; i++) {
		data[form.elements[i].name] = form.elements[i].value
	}
	
	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "../survey_settings/update_title",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#title_message').empty();
				// append validation error message
				if(res['message'] != "") $('#title_message').append(res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


/* UPDATE STATUS
	-INCLUDES-
	
*/
$("#status_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var form = document.getElementById("status_form");
	// object to contain data
	data = {}
	// extract element name : value
	for(var i = 0; i < form.elements.length; i++) {
		data[form.elements[i].name] = form.elements[i].value
	}
	
	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "../survey_settings/update_status",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#status_message').empty();
				// append validation error message
				if(res['message'] != "") $('#status_message').append(res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()