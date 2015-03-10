$(document).ready(function(){ 
	
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
			$(id + '.input_carousel ul').append('<li>No responses exist</li>').addClass('input_response');
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
			$(id + '.text_carousel ul').append('<li>No responses exist</li>').addClass('text_response');
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
		
	
});// end doc ready()
















