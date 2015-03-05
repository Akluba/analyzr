$('.indicate_type').append('<p>Multiple Choice</p>');

// hide/show choices section of add question form
$('#question_form input').on('change', function(){
	var selected_radio = $('input[name="question_type"]:checked', '#question_form').val();
	
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
	
	
	if(selected_radio == 4 || selected_radio == 5){
		$('#question_choices').hide();
	}else{
		$('#question_choices').show();
	}
});// end change()

// num used for unique data-id
var i = 0;
// keep count of choices
var count = 0;
// add to previous data-id
function increment(){
	i += 1; 
}
// add / remove choices located in add question form
$('.js_add_choice').on('click', function(){
	// limit amount of added choices
	if(count === 4) return false;
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