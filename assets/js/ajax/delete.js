$(document).ready(function(){ 

	/*
	** Delete survey
	*********************************************** */
	
	$('.js_survey_delete').on('click',function(){	
		// show delete survey confirm box
		$('#confirm_remove').show();
		// survey_id from data id
		var data = $(this).data('id');
		// CONFIRM removal
		$('.js_confirm_remove').click(function(){
			// ajax call to controller	
			$.ajax({
				type: "POST",
				url: "../survey_settings/remove_survey",
				dataType: 'json',
				data: {'survey_id': data},
				success: function(res) {
					// refresh page w/ question removed 
					window.location.href = '../home';
				}// end success
			});// end ajax post
		});// end click funtion
		// CANCEL removal
		$('.js_cancel_remove').click(function(){
			// empty question removal confirm box
			$('#confirm_remove').hide();
		});// end click function
	});// end click delete survey
	
	
	/*
	** Delete question
	*********************************************** */
	$('.js_question_delete').on('click',function(){
		// show delete survey confirm box
		$('#confirm_remove').show();	
		// question_id from data id
		var data = $(this).data('id');
		// CONFIRM removal
		$('.js_confirm_remove').click(function(){
			// ajax call to controller	
			$.ajax({
				type: "POST",
				url: "../survey_builder/remove_question",
				dataType: 'json',
				data: {'question_id': data},
				success: function(res) {
					// refresh page w/ question removed 
					location.reload();
				}// end success
			});// end ajax post
		});// end click funtion
		// CANCEL removal
		$('.js_cancel_remove').click(function(){
			// empty question removal confirm box
			$('#confirm_remove').hide();
		});// end click function
	});// end click delete question
	
	
});// end doc ready()