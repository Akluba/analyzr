<h1>Analyzr</h1>
<div class="auth_form">
	<?php 
		// Form Open
		echo form_open('#',array('id'=>'js_login_form')) . "\n"; 
		echo '<div class="error_message" id="invalid_error"></div>';
		// Email Address
		echo form_fieldset('Email Address : ');
			echo form_input(array('name'=>'email','class'=>'auth_input')) ."\n";
			echo '<div class="error_message" id="email_error"></div>';
		echo form_fieldset_close(); 
		// Password
		echo form_fieldset('Password : ');
			echo form_password(array('name'=>'password','class'=>'auth_input')) ."\n";
			echo '<div class="error_message" id="pass_error"></div>';
		echo form_fieldset_close(); 
		// Submit
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Login'))."\n";
		// Register Link
		echo '<a href="register">Register here</a>';
		// Form Close
		echo form_close()
	?>
</div>


