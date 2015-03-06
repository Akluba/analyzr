// start with js_individual_recipient click off
$('.js_individual_recipient').off('click');
$( "#js_view_overview" ).addClass( 'current_analyze_type' );
$( ".recipient_item" ).addClass( 'recipient_hidden' );


// onclick js_view_individual click on
$('#js_view_individual').on('click', function(){
	
	$( "#js_view_overview" ).removeClass( 'current_analyze_type' );
	$( ".recipient_item" ).removeClass( 'recipient_hidden' );
	$( "#js_view_individual" ).addClass( 'current_analyze_type' );
	
	
	$('.js_individual_recipient').on('click',function(){
		var chosen_recipient = this;
		// get view with question data to edit
		$.ajax({
			type: "GET",
			url: "../survey_analyze/individual/" + $(this).data('id'),
			success: function(res){
				/* -------------------------------
					APPENDING INDIVIDUAL RESULTS
				------------------------------- */
				// empty existing div
				$('section').empty();
				// append view from ajax call
				$('section').append(res);
				
				$('.recipient_item').removeClass('current_recipient_item');
				$(chosen_recipient).addClass('current_recipient_item');
				
				$('#js_view_overview').on('click',function(){
					location.reload();
				});
				
			}// end of success
		});// end ajax()
	});// end click individual recipient
});// end click individual type

$('#js_view_overview').on('click', function(){
	$('.js_individual_recipient').off('click');
	$( "#js_view_individual" ).removeClass( 'current_analyze_type' );
	$('.recipient_item').removeClass('current_recipient_item');
	$( "#js_view_overview" ).addClass( 'current_analyze_type' );
	$( ".recipient_item" ).addClass( 'recipient_hidden' );
});

