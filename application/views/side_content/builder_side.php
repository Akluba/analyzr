<script> 
	function hideChoice(radio){
		// find which radio button is selected
		var selected = radio[0].value;
		// selecting choices article
		var choices = document.getElementById('question_choices');
		// determine wheter or not to display 
		if(selected == 4 || selected == 5){
			choices.style.display = 'none';
		}else{
			choices.style.display = '';
		}// end if/else
	}// end hideChoice()
	
	// initial amout of choices available
	var choice_count = 2;
	
	// function ran when add choice is clicked
	function addChoice(){
		// limit choice amount to 6
		if(choice_count >= 6){
			return false;
		}
		// append new choice input to area
		var div = document.getElementById("additional_choices");
		div.innerHTML += "<input type='text' value='' name='choices[]'></input>";
		// increase count by 1
		choice_count ++;
	}// end addChoice()
</script>
<div id="side_container">
	<h2><strong>Add a Question</strong></h2>
	
	<?php
		echo form_open('survey/add_question/'.$survey_id)."\n";
		
		$js = 'onClick="hideChoice([question_type])"';
		
		echo '<article>';
		echo '<h4>Question type:</h4>';
		echo form_label('radio: ') ."\n";
		echo form_radio('question_type',1,TRUE,$js);
		
		echo form_label('checkbox: ') ."\n";
		echo form_radio('question_type',2,FALSE,$js);
		
		echo form_label('dropdown: ') ."\n";
		echo form_radio('question_type',3,FALSE,$js);
		
		echo form_label('input: ') ."\n";
		echo form_radio('question_type',4,FALSE,$js);
		
		echo form_label('textarea: ') ."\n";
		echo form_radio('question_type',5,FALSE,$js);
		echo '</article>' ."\n";
		
		
		echo '<article>' ."\n";
		echo '<h4>Question:</h4>' ."\n";
		$data = array(
			'name' => 'question_text',
		);
		echo form_textarea($data) ."\n";
		echo '</article>' ."\n";
		
		
		echo '<article id="question_choices">' ."\n";
		echo '<h4>Choices:</h4>' ."\n";
		echo form_input('choices[]') ."\n";
		echo form_input('choices[]') ."\n";
		echo '<div id="additional_choices"></div>';
		echo '<p onclick="addChoice()" >add choice</p>' ."\n";
		echo '</article>' ."\n";	
			
			
		echo '<article>' ."\n";
		echo '<h4>Options:</h4>' ."\n";
		echo form_checkbox('question_require',1,FALSE) ."\n";
		echo form_label('Answer required ') ."\n";
		echo '</article>' ."\n";
		
		echo form_submit('submit', 'Add Question')."\n";
		
		echo form_close()."\n";
	?>
</div>

