<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | Registration</title>
	</head>
	<body>
		<div id="main">
			<div id="login">
				<h2>Registration Form</h2>
				<?php
					echo "<div class='error_msg'>";
					echo validation_errors();
					echo "</div> \n";
					
					echo form_open('auth/registration_process')."\n";
				
					echo form_label('Create Username : ') ."\n";
					echo form_input('username') ."\n";
					
					echo "<div class='error_msg'>";
						if (isset($message_display)) {
						echo $message_display;
						}
					echo "</div> \n" ;
				
					echo form_label('Email : ') ."\n";
					$data = array(
					'type' => 'email',
					'name' => 'email_value'
					);
					echo form_input($data) ."\n";
					
					echo form_label('Password : ')."\n";
					echo form_password('password')."\n";
					
					echo form_submit('submit', 'Sign Up')."\n";
					
					echo form_close()."\n";
				?>
			</div>
		</div>
	</body>
</html>

