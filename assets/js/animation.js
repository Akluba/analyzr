$(document).ready(function(){ 
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
	
	// hide question actions
	$('.question_actions').hide();
	// hover show / hide question's actions
	$('.js_question_item').hover(function(){
		$(this).find('.question_actions').show();
	},function(){
		$(this).find('.question_actions').hide();
	})
	
	
	var LiCount = $(".swipe_input_carousel").find("ul").children("li").size();
	
	console.log(LiCount);
	
	$(".swipe_input_carousel").jCarouselLite({
	    btnNext: ".next",
	    btnPrev: ".prev",
	    visible: 1,
	    afterEnd: function(to){
		}
	});
	
	
});
















