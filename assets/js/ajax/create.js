// CREATE SURVEY
$("#survey_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var data = $(this).serialize();
	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "home/add_survey",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#message').empty();
				// append validation error message
				if(res['message'] != "") $('#message').append("&#42;"+res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


// CREATE QUESTION / ANSWERS
$("#question_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get user inputs from form
    var data = $(this).serialize();
	// posting data via ajax to controller 
	$.ajax({
		type: "POST",
		url: "../survey_builder/create_question",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#question_error').empty();
				$('#choice_error').empty();
				// append validation error message 
				if(res['text'] != "") $('#question_error').append("&#42;"+res['text']);
				if(res['choice'] != "") $('#choice_error').append("&#42;"+res['choice']);
			}else if(res['error'] == 'user'){
				location.reload();
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end of submit()


// CREATE SENT SURVEY
$("#send_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get user inputs from form
    var data = $(this).serialize();
    // posting data via ajax to controller 
	$.ajax({
		type: "POST",
		url: "../survey_send/send_survey",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#email_error').empty();
				$('#subject_error').empty();
				$('#message_error').empty();
				$('#mandrill_error').empty();
				// append validation error message 
				if(res['email'] != "" && res['email'] != undefined) $('#email_error').append("&#42;"+res['email']);
				if(res['subject'] != "" && res['subject'] != undefined) $('#subject_error').append("&#42;"+res['subject']);
				if(res['message'] != "" && res['message'] != undefined) $('#message_error').append("&#42;"+res['message']);
				if(res['mandrill'] != "" && res['mandrill'] != undefined) $('#mandrill_error').append("&#42;"+res['mandrill']);
			}else{
				location.reload();
			}// end success if/else
		}// end success
	});// end ajax post
});// end of submit()	
	
	
	
	
	

