<div class="side_container">
	<h2><strong>Survey Sendr</strong></h2>
	<?php
		
		if($question_exist == false){
			echo '<div id="restrict_send">';
			echo '<h3 class="empty_message">Sendr not available until survey is built.</h3>';
			echo '<a class="empty_btn" href="../survey_builder/' .$survey_id .'">Build Survey</a>';
			echo '</div>';
		}
		
		// OPEN FORM
		echo form_open('#', array('id'=>'send_form'))."\n";
		// SURVEY ID	
		echo form_hidden('survey_id', $survey_id);
		// USER EMAIL
		echo form_hidden('user_email', $user_email);
		// EMAIL ADDRESS
		echo form_fieldset('Email Address:');
			echo form_input(array('name'=>'send_email','class'=>'form_input'));
			echo '<div class="error_message" id="email_error"></div>';
		echo form_fieldset_close(); 
		// EMAIL SUBJECT
		echo form_fieldset('Subject:');
			echo form_input(array('name'=>'send_subject','class'=>'form_input'));
			echo '<div class="error_message" id="subject_error"></div>';
		echo form_fieldset_close(); 
		// EMAIL MESSAGE
		echo form_fieldset('Message:');
			echo form_textarea(array('name'=>'send_message','class'=>'send_textarea')) ."\n";
			echo '<div class="error_message" id="message_error"></div>';
		echo form_fieldset_close();
		// SUBMIT
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Send Survey'))."\n";
		echo '<div class="error_message" id="mandrill_error"></div>';
		echo '<div class="error_message" id="survey_error"></div>';
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>