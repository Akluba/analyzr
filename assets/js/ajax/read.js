// start with js_individual_recipient click off
$('.js_individual_recipient').off('click');

// onclick js_view_individual click on
$('#js_view_individual').on('click', function(){
	
	$('.js_individual_recipient').on('click',function(){
		// get view with question data to edit
		$.ajax({
			type: "GET",
			url: "../survey_analyze/individual/" + $(this).data('id'),
			success: function(res){
				/* -------------------------------
					APPENDING EDIT QUESTION
				------------------------------- */
				// empty existing div
				//$('section').empty();
				// hide add question form
				$('#analyze_overview').hide();
				// append view from ajax call
				$('section').append(res);
				
				$('#js_view_overview').on('click',function(){
					// empty existing div
					$('.js_individual_recipient').unbind("click");
					
					$('#analyze_individual').hide();
					$('#analyze_overview').show();
				});
				
			}// end of success
		});// end ajax()
	});// end click individual recipient
});// end click individual type

$('#js_view_overview').on('click', function(){
	$('.js_individual_recipient').off('click');
});

