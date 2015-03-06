/* **************************************************     
********** UPDATE SURVEY TITLE **********************
************************************************** */ 
$("#title_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get update title form input
	var data = $(this).serialize();
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
				if(res['message'] != "") $('#title_message').append("&#42;"+res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


/* **************************************************     
********** UPDATE SURVEY STATUS *********************
************************************************** */
$("#status_form").submit(function(event) {
	// prevent php functions from taking place
	event.preventDefault();
	// get update status form input
	var data = $(this).serialize();
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
				if(res['message'] != "") $('#status_message').append("&#42;"+res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


/* **************************************************     
********** UPDATE QUESTION / CHOICES ****************
************************************************** */
$('.js_question_edit').on('click',function(){
	// get view with question data to edit
	$.ajax({
		type: "GET",
		url: "../survey_builder/edit_question/" + $(this).data('id'),
		success: function(res){
			
			/* -------------------------------
				APPENDING EDIT QUESTION
			------------------------------- */
			// empty existing div
			$('aside').empty();
			// append view from ajax call
			$('aside').append(res);
			// cancel edit return to add question
			$('.js_cancel_edit').on('click',function(){
				location.reload();
			});// end click cancel	
			
			
			/* -------------------------------
				CHECK QUESTION TYPE 
				WHEN LOADED
			------------------------------- */
			// selected radio btn value
			var selected_radio = $('input[name="question_type"]:checked', '#edit_question_form').val();
			
			// indicate what type of question is selected
			switch(selected_radio){
				case "1":
					$('.indicate_type').empty();
					$('.indicate_type').append('<p>Multiple Choice</p>');
					break;
				case "2":
					$('.indicate_type').empty();
					$('.indicate_type').append('<p>CheckBox</p>');
					break;
				case "3":
					$('.indicate_type').empty();
					$('.indicate_type').append('<p>Select Dropdown</p>');
					break;
				case "4":
					$('.indicate_type').empty();
					$('.indicate_type').append('<p>Text Box</p>');
					break;
				case "5":
					$('.indicate_type').empty();
					$('.indicate_type').append('<p>Comment Box</p>');
					break;
			}
			
			// if question_type is an input or textarea
			if(selected_radio == 4 || selected_radio == 5){
				// hide the choice inputs
				$('#question_choices').hide();
			}else{
				// show the choice inputs
				$('#question_choices').show();
			}
			
			
			/* -------------------------------
				CHECK QUESTION TYPE 
				WHEN CHANGED
			------------------------------- */
			$('#edit_question_form input').on('change', function(){
				// selected radio btn value
				var selected_radio = $('input[name="question_type"]:checked', '#edit_question_form').val();
				
				// indicate what type of question is selected
				switch(selected_radio){
					case "1":
						$('.indicate_type').empty();
						$('.indicate_type').append('<p>Multiple Choice</p>');
						break;
					case "2":
						$('.indicate_type').empty();
						$('.indicate_type').append('<p>CheckBox</p>');
						break;
					case "3":
						$('.indicate_type').empty();
						$('.indicate_type').append('<p>Select Dropdown</p>');
						break;
					case "4":
						$('.indicate_type').empty();
						$('.indicate_type').append('<p>Text Box</p>');
						break;
					case "5":
						$('.indicate_type').empty();
						$('.indicate_type').append('<p>Comment Box</p>');
						break;
				}
				
				// if question_type is an input or textarea
				if(selected_radio == 4 || selected_radio == 5){
					// hide the choice inputs
					$('#question_choices').hide();
				}else{
					// show the choice inputs
					$('#question_choices').show();
				}
			});// end change() 
			
			
			/* -------------------------------
				HANDLING EXISTING 
				CHOICES
			------------------------------- */
			var existing = $('input[name="choices[]"]').length, // get count of existing choices
				i = 2, // keep count of additional choices +2 required
				count = existing; // count begins at num of existing choices
				
			// add to previous data-id
			function increment(){
				i += 1; 
			}
			
			// enable removal of choice with exception of first two
			$('input[data-id]').slice(2).each(function(){
				// change appearence of additional input fields
				$(this).addClass('additional_choice_input');
				// run increment to determine data-id
				increment();
				// create ancor to allow for removal
				var a = '<a href="#" data-id="' + i + '" class="js_remove_choice remove_choice_anchor icon" data-icon="&#xe025;"></div></a> ';
				// create parent div
				var d = '<div data-id="' + i +'"></div>';
				// wrap existing input in div
				var element = $(this).wrap(d);
				// append ancor to div
				$(element).after(a);
				// remove choice elements 
				$('.js_remove_choice').unbind('click').on('click', function(){
					$(this).parent().remove();
					count--;
				});// end click() remove
			});// end each() EXISTING CHOICES FUNCTIONALITY 
		
			
			/* -------------------------------
				CREATING NEW 
				CHOICES
			------------------------------- */
			$('.js_add_choice').on('click', function(){
				// limit amount of added choices
				if(count === 6) return false;
				// run increment function to get id
				increment();
				// add to count of added inputs
				count++;
				// group of elements to be added for additional choice
				var s = '<div data-id="' + i +'">' +
				'<input class="form_input additional_choice_input" type="text" name="choices[]">' +
				'<a href="#" data-id="' + i + '" class="js_remove_choice remove_choice_anchor icon" data-icon="&#xe025;"></a>';
				// appending additional choice elements
				$('#additional_choices').append(s);
				// remove choice elements 
				$('.js_remove_choice').unbind('click').on('click', function(){
					$(this).parent().remove();
					count--;
				});// end click() remove
			});// end click() add
			
			
			/* -------------------------------
				SUBMITTING DATA
				VIA AJAX
			------------------------------- */
			$('#edit_question_form').submit(function(event){
				event.preventDefault();
				// get updated data from user inputs
				var data = $(this).serialize();
				// posting data via ajax to controller
				$.ajax({
					type: "POST",
					url: "../survey_builder/update_question",
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
			});// end submit() edit_question_form	
		}// end success() 
	});// end ajax get
});// end click question edit()






