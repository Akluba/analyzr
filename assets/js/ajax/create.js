$(document).ready(function(){ 
	
	/*
	** Create a survey
	*********************************************** */
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
	
	
	/*
	** Create a question
	*********************************************** */
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
	
	
	/*
	** Create a sent survey
	*********************************************** */
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
					$('#survey_error').empty();
					// append validation error message 
					if(res['email'] != "" && res['email'] != undefined) $('#email_error').append("&#42;"+res['email']);
					if(res['subject'] != "" && res['subject'] != undefined) $('#subject_error').append("&#42;"+res['subject']);
					if(res['message'] != "" && res['message'] != undefined) $('#message_error').append("&#42;"+res['message']);
					if(res['mandrill'] != "" && res['mandrill'] != undefined) $('#mandrill_error').append("&#42;"+res['mandrill']);
					if(res['survey'] != "" && res['survey'] != undefined) $('#survey_error').append("&#42;"+res['survey']);
				}else{
					location.reload();
				}// end success if/else
			}// end success
		});// end ajax post
	});// end of submit()
	
	
	/*
	** Create a response
	*********************************************** */
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
				if(res['error'] == true ){
					if(res['required'] != "" && res['required'] != undefined) $('#required_error').html(res['required']);
					$('#confirm_remove').show();
					$('.js_close_window').on('click',function(){
						$('#confirm_remove').hide();
					});
				}else{
					window.location.href = '../thank_you';
				}
			}// end success
		});// end ajax post
	});// end submit()	
	
	
});// end doc ready()