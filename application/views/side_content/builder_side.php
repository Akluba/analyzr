<div id="side_container">
	<h2><strong>Add a Question</strong></h2>
	<?php
		// OPEN FORM
		echo form_open('survey/create_question/'.$survey_id , array('id'=>'question_form'))."\n";
		// SURVEY ID -- hidden input 	
		echo form_hidden('survey_id', $survey_id);
		// function to run for finding selected radio button
		$js = 'onClick="hideChoice([question_type])"';
		// QUESTION TYPE -- radio button
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
		// QUESTION TEXT -- text area
		echo '<article>' ."\n";
		echo '<h4>Question:</h4>' ."\n";
		echo '<div id="question_error"></div>';
		$data = array(
			'name' => 'question_text',
		);
		echo form_textarea($data) ."\n";
		echo '</article>' ."\n";
		// QUESTION CHOICES -- text inputs
		echo '<article id="question_choices">' ."\n";
		echo '<h4>Choices:</h4>' ."\n";
		echo '<div id="choice_error"></div>';
		echo form_input('choices[]') ."<br />";
		echo form_input('choices[]') ."<br />";
		echo '<div id="additional_choices"></div>';
		echo '<p onclick="addChoice()" >add choice</p>' ."\n";
		echo '</article>' ."\n";	
		// OPTIONS -- check box
		echo '<article>' ."\n";
		echo '<h4>Options:</h4>' ."\n";
		$check_data = array(
			'name'        => 'question_require',
			'id'          => 'required',
			'value'       => 1,
			'checked'     => FALSE
		);
		echo form_checkbox($check_data) ."\n";
		echo form_label('Answer required ') ."\n";
		echo '</article>' ."\n";
		// SUBMIT
		echo form_submit('submit', 'Add Question')."\n";
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>