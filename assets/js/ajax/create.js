/* CREATE QUESTION / ANSWERS
	-INCLUDES-
	gather user inputs
	send data to controller
	display response 
*/
$("#survey_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get create survey form inputs
	var form = document.getElementById("survey_form");
	// object to contain data
	data = {}
	// extract element name : value
	for(var i = 0; i < form.elements.length; i++) {
		data[form.elements[i].name] = form.elements[i].value
	}
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
				if(res['message'] != "") $('#message').append(res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


/* CREATE QUESTION / ANSWERS
	-INCLUDES-
	gather user inputs
	send data to controller
	display response
*/
$("#question_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// getting selected radio input
	var r = document.getElementsByName('question_type');
	for (var i = 0, length = r.length; i < length; i++) {
	    if (r[i].checked) {
	        // checked radio
			var selected = r[i].value;
	        // stop checking when selected is found
	        break;
	    }
	}
	// determing required checkbox checked state
	var required = document.getElementById('required').checked;
	// data object to contain all user inputs
	data = {}
	// get all inputs from form
	var myForm = document.getElementById("question_form");
	// Extract Each Element Value
    for(var i = 0; i < myForm.elements.length; i++) {
        if(myForm.elements[i].name.indexOf('[]') > -1){
            var name = myForm.elements[i].name.replace('[]','');
            if(data[name] === undefined) data[name] = [];
            data[name].push(myForm.elements[i].value);
        }else if(myForm.elements[i].name == 'question_type'){
	        data[myForm.elements[i].name] = selected
        }else if(myForm.elements[i].name == 'question_require'){
	        if(required === true){
	        	data[myForm.elements[i].name] = 1;
	        }else{
		        data[myForm.elements[i].name] = 0;
		    }
        }else{
           data[myForm.elements[i].name] = myForm.elements[i].value
        }
    }// end for loop
	// posting data via ajax to controller 
	$.ajax({
		type: "POST",
		url: "../create_question/" + data.survey_id,
		dataType: 'json',
		data: data,
		success: function(res) {
			if(res['error'] == true ){
				// clear existing errors
				$('#question_error').empty();
				$('#choice_error').empty();
				// append validation error message 
				if(res['text'] != "") $('#question_error').append(res['text']);
				if(res['choice'] != "") $('#choice_error').append(res['choice']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end of submit()