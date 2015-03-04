<h1>Analyzr</h1>
<div class="auth_form">
	<?php 
		echo form_open('#',array('id'=>'js_login_form')) . "\n"; 
		
		echo form_label('Email Address : ') ."\n";
		echo '<div class="error_message" id="email_error"></div>';
		echo form_input(array('name'=>'email','class'=>'auth_input')) ."\n";
		
		echo form_label('Password : ') ."\n";
		echo '<div class="error_message" id="pass_error"></div>';
		echo form_input(array('type'=>'password','name'=>'password','class'=>'auth_input')) ."\n";
		
		echo '<div class="error_message" id="invalid_error"></div>';
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Login'))."\n";
		
		echo '<a href="register">Register here</a>';
		
		echo form_close()
	?>
</div>


