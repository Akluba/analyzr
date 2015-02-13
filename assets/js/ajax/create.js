


/* CREATE QUESTION / ANSWERS
	-INCLUDES-
	
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
    
	
	// post data to controller to validate then add to database
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
				// 
				if(res['text'] != "") $('#question_error').append(res['text']);
				if(res['choice'] != "") $('#choice_error').append(res['choice']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end of submit()