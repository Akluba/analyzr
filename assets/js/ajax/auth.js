$("#js_login_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var data = $(this).serialize();
	
	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "auth/login_process",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#email_error').empty();
				$('#pass_error').empty();
				$('#invalid_error').empty();
				// append validation error message 
				if(res['email_error'] != "" && res['email_error'] != undefined) $('#email_error').append("&#42;"+res['email_error']);
				if(res['pass_error'] != "" && res['pass_error'] != undefined) $('#pass_error').append("&#42;"+res['pass_error']);
				if(res['invalid_error'] != "" && res['invalid_error'] != undefined) $('#invalid_error').append("&#42;"+res['invalid_error']);
			}else{
				window.location.href = 'home';
			}
		}// end success
	});// end ajax post
});// end submit()


$("#js_register_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var data = $(this).serialize();
	
	// posting data via ajax to controller
	$.ajax({
		type: "POST",
		url: "auth/register_process",
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#user_error').empty();
				$('#email_error').empty();
				$('#pass_error').empty();
				$('#invalid_error').empty();
				// append validation error message 
				if(res['user_error'] != "" && res['user_error'] != undefined) $('#user_error').append("&#42;"+res['user_error']);
				if(res['email_error'] != "" && res['email_error'] != undefined) $('#email_error').append("&#42;"+res['email_error']);
				if(res['pass_error'] != "" && res['pass_error'] != undefined) $('#pass_error').append("&#42;"+res['pass_error']);
				if(res['invalid_error'] != "" && res['invalid_error'] != undefined) $('#invalid_error').append("&#42;"+res['invalid_error']);
			}else{
				window.location.href = 'home';
			}
		}// end success
	});// end ajax post
});// end submit()