<div class="side_container">
	<?php
		// OPEN FORM
		echo form_open('#', array('id'=>'send_form'))."\n";
		// SURVEY ID -- hidden input 	
		echo form_hidden('survey_id', $survey_id);
		// EMAIL ADDRESS
		echo '<div id="email_error"></div>';
		echo form_label('email address: ') ."\n";
		echo form_input('send_email');
		// EMAIL SUBJECT
		echo '<div id="subject_error"></div>';
		echo form_label('subject: ') ."\n";
		echo form_input('send_subject');
		// EMAIL MESSAGE
		echo '<div id="message_error"></div>';
		echo form_label('message: ') ."\n";
		echo form_textarea('send_message') ."\n";
		// SUBMIT
		echo form_submit('submit', 'Send Survey')."\n";
		// CLOSE FORM
		echo form_close()."\n";
	?>
</div>