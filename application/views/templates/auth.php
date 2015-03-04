<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/frontend_style.css">
		
		<!-- 	jQuery	 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="auth_area">
			<?php if(isset($analyzrContent)){print $analyzrContent; }?>
		</div>
		
		
		<!--  User login / register ajax	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/auth.js"></script>
	</body>
</html>