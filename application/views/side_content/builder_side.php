<h3>Add a Question</h3>

<?php
	echo form_open('survey/add_question/'.$survey_id)."\n";
	
	echo '<h4>Question type:</h4>';
	echo form_label('radio: ') ."\n";
	echo form_radio('question_type',1);
	echo form_label('input: ') ."\n";
	echo form_radio('question_type',2);
	echo form_label('checkbox: ') ."\n";
	echo form_radio('question_type',3);
	echo form_label('textarea: ') ."\n";
	echo form_radio('question_type',4);
	echo form_label('dropdown: ') ."\n";
	echo form_radio('question_type',5);
	
	echo '<h4>Question:</h4>';
	$data = array(
		'name' => 'question_text',
		'rows' => 8,
		'cols' => 38
	);
	echo form_textarea($data);
	
	echo '<h4>Choices:</h4>';
	echo form_input('choice_1');
	echo form_input('choice_2');
	
	echo '<h4>Options:</h4>';
	echo form_checkbox('question_require',1,FALSE);
	echo form_label('Answer required ') ."\n";
	
	echo form_submit('submit', 'Add Question')."\n";
	
	echo form_close()."\n";
?>