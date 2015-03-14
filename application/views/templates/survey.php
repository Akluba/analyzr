<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/frontend_style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/confirm.css">

		
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/webfont/webfont.css">	
		<link rel="stylesheet" href="<?php echo asset_url();?>css/font-awesome/css/font-awesome.min.css">
		
		<!-- 	jQuery	 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<?php if(isset($headerContent)){print $headerContent; }?>
		</header>
		
			<?php if(isset($analyzrContent)){print $analyzrContent; }?>
		
		
		<!--  Create ajax  -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/create.js"></script>
		
	</body>
</html>