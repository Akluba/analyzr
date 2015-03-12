$(document).ready(function(){ 
	
	/* ###########################################################
	######## NAV #################################################	
	########################################################### */
	
	/*
	** Current selected nav element
	*********************************************** */
	
	// get id of container
	var activeSection = $('.container').attr('id');
	// add current_selection class to current page
	switch(activeSection){
		case 'settings_active_container':
			$('#setting_icon').addClass('current_section');
			break;
		case 'builder_active_container':
			$('#builder_icon').addClass('current_section');
			break;
		case 'send_active_container':
			$('#send_icon').addClass('current_section');
			break;
		default:
			$('#analyze_icon').addClass('current_section');
			break;
	}// end switch
	
	
	
	/* ###########################################################
	######## BUTTONS #############################################
	########################################################### */
	
	/*
	** Button state for Inputs
	*********************************************** */
	
	// get original value from input 
	var originalVal = $('.form_input').val();
	// on keyup compare value and change button attributes 
	$('.form_input').on('keyup', function (){
		if($('.form_input').val() != originalVal){
			$('.js_button_change').css({'background-color':'#44749d','color':'#fefafa'});
		}else{
			$('.js_button_change').css({'background-color':'#85929d','color':'#cccccc'});
		}
	});// end keyup()
	
	
	/*
	** Button state for Select
	*********************************************** */
	
	// get original value from select
	var statusVal = $('.form_select').val();
	// on change compare value and change button attributes 
	$('.form_select').on('change',function(){
		if($('.form_select').val() != statusVal){
			$('#js_update_status_btn').css({'background-color':'#44749d','color':'#fefafa'});
		}else{
			$('#js_update_status_btn').css({'background-color':'#85929d','color':'#cccccc'});
		}	
	});// end change()
	
	
	/*
	** Question builder actions
	*********************************************** */
	
	// hide question actions
	$('.question_actions').hide();
	// hover show / hide question's actions
	$('.js_question_item').hover(function(){
		$(this).find('.question_actions').show();
	},function(){
		$(this).find('.question_actions').hide();
	});// end hover()
	
	
	/* ###########################################################
	######## CAROUSELS ###########################################
	########################################################### */
	
	/*
	** Input carousel
	*********************************************** */
	
	// start position at 1
	var liPosition = 1;
	
	// functionality for each input carousel
	$(".input_carousel").each(function(){
		// the id of .input_carousel
		var id = "#" + $(this).attr("id");
		// how many li elements
		var liCount = $(id).find("ul").children("li").size();
		// no li elements exist
		if(liCount == 0){
			$(id + '.input_carousel ul').append('<li class="input_response"><p>No responses exist</p></li>');
			$(id + '.current_num').append('0 of 0');
		// responses exist
		}else{
			// initial position 
			$(id + '.current_num').append( liPosition + ' of ' + liCount);
			// next clicked
			$(id + " .next").on('click',function(){
				if(liPosition >= liCount){
					// set liPosition back to 1
					liPosition = 1;
				}else{
					// add to the liPosition
					liPosition ++;
				}
			});// end click()
			// prev clicked
			$(id + " .prev").on('click',function(){
				if($('.active').is(':first-child') || liPosition <= 1){
					// set liPostion on highest num
					liPosition = liCount;
				}else{
					// minus from the liPosition 
					liPosition --;
				}
			});// end click()
		}// end if/else liCount
		// init carousels
		$(id + ".input_carousel").jCarouselLite({
			btnNext: id + " .next",
			btnPrev: id + " .prev",
			visible: 1,
			speed: 10,
			// after slide has changes
			afterEnd: function(a){
				if(liCount != 0){
					// append new position information
					$(id + '.current_num').empty();
					$(id + '.current_num').append( liPosition + ' of ' + liCount);
				}
			}// end afterEnd
		}); // end jCarouselLite()
	 }); // end each()
	 
	 
	/*
	** Text carousel
	*********************************************** */
	
	$(".text_carousel").each(function(){
		// the id of .text_carousel
		var id = "#" + $(this).attr("id");
		// how many li elements
		var liCount = $(id).find("ul").children("li").size();
		// no li elements exist
		if(liCount == 0){
			$(id + '.text_carousel ul').append('<li><p>No responses exist</p></li>').addClass('text_response');
			$(id + '.current_num').append('0 of 0');
		}else{
			// initial position 
			$(id + '.current_num').append( liPosition + ' of ' + liCount);
			// next clicked
			$(id + " .next").on('click',function(){
				if(liPosition >= liCount){
					// set liPosition back to 1
					liPosition = 1;
				}else{
					// add to the liPosition
					liPosition ++;
				}
			});// end click()
			// prev clicked
			$(id + " .prev").on('click',function(){
				if($('.active').is(':first-child') || liPosition <= 1){
					// set liPostion on highest num
					liPosition = liCount;
				}else{
					// minus from the liPosition 
					liPosition --;
				}
			});// end click()
		}// end if/else liCount
		// init carousels
		$(id + ".text_carousel").jCarouselLite({
			btnNext: id + " .next",
			btnPrev: id + " .prev",
			visible: 1,
			speed: 10,
			autoWidth: true,
			responsive: true
		}); // end jCarouselLite()
	});// end each()
	
	
	
	/* ###########################################################
	######## FORMS ###############################################
	########################################################### */
	
	/*
	** Question Type 
	*********************************************** */
	
	// init question type -- mult choice
	$('.indicate_type').append('<p>Multiple Choice</p>');
	
	// hide/show choices section of add question form
	$('#question_form input').on('change', function(){
		// value of selected radio btn question type 
		var selected_radio = $('input[name="question_type"]:checked', '#question_form').val();
		// append name of selected radio btn question type
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
		}// end of switch
		
		// question type text based -- remove choices 
		if(selected_radio == 4 || selected_radio == 5){
			$('#question_choices').hide();
		}else{
			$('#question_choices').show();
		}
	});// end change()
	
	
	/*
	** Choices functionality 
	*********************************************** */
	
	// num used for unique data-id
	var dataId = 0;
	// keep choiceCount of choices
	var choiceCount = 0;
	// add to previous data-id
	function increment(){
		dataId += 1; 
	}
	// add / remove choices located in add question form
	$('.js_add_choice').on('click', function(){
		// limit amount of added choices
		if(choiceCount === 4) return false;
		// run increment function to get id
		increment();
		// add to choiceCount of added inputs
		choiceCount++;
		// group of elements to be added for additional choice
		var appendedSpan = '<div data-id="' + dataId +'">' +
		'<input class="form_input additional_choice_input" type="text" name="choices[]">' +
		'<a href="#" data-id="' + dataId + '" class="js_remove_choice remove_choice_anchor icon" data-icon="&#xe025;"></a>';
		// appending additional choice elements
		$('#additional_choices').append(appendedSpan);
		// remove choice elements 
		$('.js_remove_choice').unbind('click').on('click', function(){
			$(this).parent().remove();
			choiceCount--;
		});// end click() remove
	});// end click() add
		
	
});// end doc ready()