<div class="side_container" id="js_editform">
	<h2><strong>Edit Question</strong></h2>
	<?php
		// OPEN FORM
		echo form_open('#', array('id'=>'edit_question_form'))."\n";
		// SURVEY ID -- hidden input 	
		echo form_hidden('survey_id', $survey_id);
		echo form_hidden('question_id', $question_id);
		// QUESTION TYPE
		echo form_fieldset('Question Type');
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
		echo form_fieldset_close(); 
		// QUESTION TEXT 
		echo form_fieldset('Survey Question');
			$text_data = array(
				'class' => 'question_textarea',
				'name' => 'question_text',
				'value' => $question_text
			);
			echo form_textarea($text_data) ."\n";
			echo '<div class="error_message" id="question_error"></div>';
		echo form_fieldset_close(); 
		// QUESTION CHOICES
		echo form_fieldset('Survey Choices',array('id'=>'question_choices'));
			$i = 1;
			if($question_type != 4 && $question_type != 5){
				foreach($choices as $choice){
					$choice_data =array(
						'class' => 'form_input',
						'name' => 'choices[]',
						'value' => $choice->answerText,
						'data-id' => $i++
					);
					echo form_input($choice_data);
				}// end foreach choice
			}else{
				$choice_data =array(
					'class' => 'form_input',
					'name' => 'choices[]'
				);
				echo form_input($choice_data);
				echo form_input($choice_data);
			}
			echo '<div id="additional_choices"></div>';
			echo '<div class="error_message" id="choice_error"></div>';
			echo '<p class="js_add_choice add_choice_btn">add choice</p>' ."\n";
		echo form_fieldset_close();
			
		// OPTIONS -- check box
		echo form_fieldset('Survey Options');
			$check_data = array(
				'name' => 'question_require',
				'id'   => 'required',
				'value' => 1,
				'checked' => $question_require == 1
			);
			echo form_checkbox($check_data) ."\n";
			echo form_label('Answer required ') ."\n";
		echo form_fieldset_close();
		// SUBMIT
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Save Question'));
		// CANCEL
		echo '<a href="#" class="js_cancel_edit">Cancel</a>';
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>