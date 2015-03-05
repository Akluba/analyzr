<div class="side_container" id="js_addform">
	<h2><strong>Add a Question</strong></h2>
	<?php
		// OPEN FORM
		echo form_open('#', array('id'=>'question_form'))."\n";
		// SURVEY ID	
		echo form_hidden('survey_id', $survey_id);
		
		
		
		// QUESTION TYPE
		echo form_fieldset('Question Type');
		echo '<div class="type_selector">';
			
			echo form_radio(array('id'=>'radio','name'=>'question_type','value'=>1,'checked'=>TRUE));
			echo form_label('', 'radio', array('class'=> 'type_img radio')) ."\n";
			
			
			echo form_radio(array('id'=>'checkbox','name'=>'question_type','value'=>2,'checked'=>FALSE));
			echo form_label('', 'checkbox', array('class'=> 'type_img checkbox')) ."\n";
			
			
			echo form_radio(array('id'=>'dropdown','name'=>'question_type','value'=>3,'checked'=>FALSE));
			echo form_label('', 'dropdown', array('class'=> 'type_img dropdown')) ."\n";
			
			
			echo form_radio(array('id'=>'input','name'=>'question_type','value'=>4,'checked'=>FALSE));
			echo form_label('', 'input', array('class'=> 'type_img input')) ."\n";
			
			
			echo form_radio(array('id'=>'textarea','name'=>'question_type','value'=>5,'checked'=>FALSE));
			echo form_label('', 'textarea', array('class'=> 'type_img textarea')) ."\n";
			
		echo '</div>';
		echo form_fieldset_close(); 
		
		
		
		
		// QUESTION TEXT
		echo form_fieldset('Survey Question');
			$data = array(
				'name' => 'question_text',
				'class' => 'question_textarea'
			);
			echo form_textarea($data) ."\n";
			echo '<div class="error_message" id="question_error"></div>';
		echo form_fieldset_close(); 
		// QUESTION CHOICES
		echo form_fieldset('Survey Choices',array('id'=>'question_choices'));
			echo form_input(array('name'=>'choices[]','class'=>'form_input'));
			echo form_input(array('name'=>'choices[]','class'=>'form_input'));
			echo '<div id="additional_choices"></div>';
			echo '<div class="error_message" id="choice_error"></div>';
			echo '<p class="js_add_choice add_choice_btn">add choice</p>' ."\n";
		echo form_fieldset_close(); 	
		// OPTIONS
		echo form_fieldset('Survey Options');
			$check_data = array(
				'name'        => 'question_require',
				'id'          => 'required',
				'value'       => 1,
				'checked'     => TRUE
			);
			echo form_checkbox($check_data) ."\n";
			echo form_label('Answer required ') ."\n";
		echo form_fieldset_close(); 
		// SUBMIT
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Add Question'));
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>