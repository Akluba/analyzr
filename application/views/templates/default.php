<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		
		<!-- 	Style	 -->
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/confirm.css">
		
		<!-- 	Fonts	 -->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/webfont/webfont.css">
		
		<!-- 	jQuery	 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		
		<!-- 	Plugin	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/slider.js"></script>
	</head>
	<body>
		<header>
			<?php if(isset($headerContent)){print $headerContent; }?>
		</header>
		<div id ="parent">
			<nav>
				<?php if(isset($navContent)){print $navContent; }?>
			</nav>
			<section>
				<?php if(isset($mainContent)){print $mainContent; }?>
			</section>
			<aside>
				<?php if(isset($sideContent)){print $sideContent; }?>
			</aside>
		</div>
		
		<!-- 	Animations	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/animation.js"></script>
		
		<!-- 	CRUD Functionality	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/create.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/read.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/update.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/delete.js"></script>
		
	</body>
</html>