// UPDATE SURVEY TITLE
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
				if(res['message'] != "") $('#title_message').append(res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


// UPDATE SURVEY STATUS
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
				if(res['message'] != "") $('#status_message').append(res['message']);
			}else{
				location.reload();
			}
		}// end success
	});// end ajax post
});// end submit()


// UPDATE QUESTION
$('.js_question_edit').on('click',function(){
	// get view with question data to edit
	$.ajax({
		type: "GET",
		url: "../survey_builder/edit_question/" + $(this).data('id'),
		success: function(res){
			// empty existing div
			$('aside').empty();
			// hide add question form
			$('#js_addform').hide();
			// append view from ajax call
			$('aside').append(res);
			// cancel edit return to add question
			$('.js_cancel_edit').on('click',function(){
				location.reload();
			});// end click cancel	
			
			// hide/show choices section of edit question form 
			$('#edit_question_form input').on('change', function(){
				var selected_radio = $('input[name="question_type"]:checked', '#edit_question_form').val();
				if(selected_radio == 4 || selected_radio == 5){
					$('#question_choices').hide();
				}else{
					$('#question_choices').show();
				}
			});// end change() hide/show
			
			// get count of existing choices
			var existing = $('input[name="choices[]"]').length;
			// keep count of additional choices +2 required
			var i = 2;
			// count begins at num of existing choices
			var count = existing;
			// add to previous data-id
			function increment(){
				i += 1; 
			}
			
			// EXISTING CHOICES -- removal with exception of first two
			$('input[data-id]').slice(2).each(function(){
				// run increment to determine data-id
				increment();
				// create ancor to allow for removal
				var a = '<a href="#" data-id="' + i + '" class="js_remove_choice">x</a> ';
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
		
		
			// NEW CHOICES -- add / remove choice
			$('.js_add_choice').on('click', function(){
				// limit amount of added choices
				if(count === 6) return false;
				// run increment function to get id
				increment();
				// add to count of added inputs
				count++;
				// group of elements to be added for additional choice
				var s = '<div data-id="' + i +'">' +
				'<input type="text" name="choices[]">' +
				'<a href="#" data-id="' + i + '" class="js_remove_choice">x</a>';
				// appending additional choice elements
				$('#additional_choices').append(s);
				// remove choice elements 
				$('.js_remove_choice').unbind('click').on('click', function(){
					$(this).parent().remove();
					count--;
				});// end click() remove
			});// end click() add
			
			
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






