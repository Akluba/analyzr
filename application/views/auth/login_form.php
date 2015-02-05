<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ananlyzr | Login</title>
	</head>
	<body>
	<?php
	if (isset($logout_message)) {
	echo "<div class='message'>";
	echo $logout_message;
	echo "</div>";
	}
	?>
	<?php
	if (isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
	}
	echo "\n"
	?>
		<div id="main">
			<div id="login">
				<h2>Login Form</h2>
				<?php echo form_open('auth/login_process') . "\n"; ?>
					<?php
						echo "<div class='error_msg'>";
						if (isset($error_message)) {
							echo $error_message;
						}
						echo validation_errors();
						echo "</div> \n";
					?>
					<label>Email Address :</label>
					<input type="text" name="email" id="email" placeholder="email address"/>
					<label>Password :</label>
					<input type="password" name="password" id="password" placeholder="**********"/>
					<input type="submit" value=" Login " name="submit"/>
					<a href="registration_form">To SignUp Click Here</a>
				<?php echo form_close() ."\n"; ?>
			</div>
		</div>
	</body>
</html>

