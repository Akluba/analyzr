<h1>Analyzr</h1>
<div class="auth_form">
	<?php
		echo form_open('auth/registration_process')."\n";
	
		echo form_label('Create Username : ') ."\n";
		echo form_input(array('name'=>'username','class'=>'auth_input')) ."\n";
	
		echo form_label('Email : ') ."\n";
		$data = array(
		'type' => 'email',
		'name' => 'email_value',
		'class' => 'auth_input'
		);
		echo form_input($data) ."\n";
		
		echo form_label('Password : ')."\n";
		echo form_password(array('name'=>'password','class'=>'auth_input'))."\n";
		
		echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Register'))."\n";
		
		echo form_close()."\n";
	?>
</div>