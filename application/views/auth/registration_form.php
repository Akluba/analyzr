<h1>Analyzr</h1>
<div class="auth_form">
	<?php
		// Form Open
		echo form_open('#',array('id'=>'js_register_form'))."\n";
		// Username
		echo form_fieldset('Create Username : ');
			echo form_input(array('name'=>'username','class'=>'auth_input')) ."\n";
			echo '<div class="error_message" id="user_error"></div>';
		echo form_fieldset_close(); 
		// Email
		echo form_fieldset('Email Address : ');
			$data = array(
			'name' => 'email',
			'class' => 'auth_input'
			);
			echo form_input($data) ."\n";
			echo '<div class="error_message" id="invalid_error"></div>';
			echo '<div class="error_message" id="email_error"></div>';
		echo form_fieldset_close(); 
		// Password
		echo form_fieldset('Password : ');
			echo form_password(array('name'=>'password','class'=>'auth_input'))."\n";
			echo '<div class="error_message" id="pass_error"></div>';
		echo form_fieldset_close(); 
		// Submit
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Register'))."\n";
		// Form Close
		echo form_close()."\n";
	?>
</div>