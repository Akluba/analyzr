<div class="side_container" id="js_editform">
	<h2><strong>Edit Question</strong></h2>
	<?php
		// OPEN FORM
		echo form_open('#', array('id'=>'edit_question_form'))."\n";
		// SURVEY ID -- hidden input 	
		echo form_hidden('question_id', $question_id);
		// QUESTION TYPE -- radio button
		echo '<article>';
		echo '<h4>Question type:</h4>';
		echo form_label('radio: ') ."\n";
		echo form_radio('question_type',1,$question_type == 1);
		echo form_label('checkbox: ') ."\n";
		echo form_radio('question_type',2,$question_type == 2);
		echo form_label('dropdown: ') ."\n";
		echo form_radio('question_type',3,$question_type == 3);
		echo form_label('input: ') ."\n";
		echo form_radio('question_type',4,$question_type == 4);
		echo form_label('textarea: ') ."\n";
		echo form_radio('question_type',5,$question_type == 5);
		echo '</article>' ."\n";
		
		// QUESTION TEXT -- text area
		echo '<article>' ."\n";
		echo '<h4>Question:</h4>' ."\n";
		echo '<div id="question_error"></div>';
		$text_data = array(
			'name' => 'question_text',
			'value' => $question_text
		);
		echo form_textarea($text_data) ."\n";
		echo '</article>' ."\n";
		
		// QUESTION CHOICES -- text inputs
		echo '<article id="question_choices">' ."\n";
		echo '<h4>Choices:</h4>' ."\n";
		echo '<div id="choice_error"></div>';
		$i = 1;
		foreach($choices as $choice){
			$choice_data =array(
				'name' => 'choices[]',
				'value' => $choice->answerText,
				'data-id' => $i++
			);
			echo form_input($choice_data);
		}
		echo '<div id="additional_choices"></div>';
		echo '<p class="js_add_choice">add choice</p>' ."\n";
		echo '</article>' ."\n";
			
		// OPTIONS -- check box
		echo '<article>' ."\n";
		echo '<h4>Options:</h4>' ."\n";
		$check_data = array(
			'name' => 'question_require',
			'id'   => 'required',
			'value' => 1,
			'checked' => $question_require == 1
		);
		echo form_checkbox($check_data) ."\n";
		echo form_label('Answer required ') ."\n";
		echo '</article>' ."\n";
		// SUBMIT
		echo form_submit('submit', 'Save Question')."\n";
		// CANCEL
		echo '<a href="#" class="js_cancel_edit">Cancel</a>';
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>