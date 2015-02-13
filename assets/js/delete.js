

/* REMOVE QUESTION
	-INCLUDES-
	question
	related answers
*/
function remove_question(question_id){
	// dynamically create confirmation box
	$('#confirm_remove').append('<div id="confirmOverlay">');
	$('#confirmOverlay').append('<div id="confirmBox">');
	$('#confirmBox').append('<h1>Remove Question</h1>');
	$('#confirmBox').append('<p>Description of what is about to happen</p>');
	$('#confirmBox').append('<div id="confirmButtons">');
	$('#confirmButtons').append('<a class="remove" href="#">Yes<span></span></a>');
	$('#confirmButtons').append('<a class="back" href="#">No<span></span></a>');	
	
	// confirming removal
	$('.remove').click(function(){
		// ajax call to controller	
		$.ajax({
			type: "POST",
			url: "../remove_question/" + question_id,
			success: function(res) {
				// refresh page w/ question removed 
				location.reload();
			}// end success
		});// end ajax post
	});// end click funtion
	
	// non removal
	$('.back').click(function(){
		// empty question removal confirm box
		$('#confirm_remove').empty();
	});// end click function		
}// end remove_question()
