<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/confirm.css">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/webfont/webfont.css">	
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<?php if(isset($headerContent)){print $headerContent; }?>
		</header>
		<div id ="parent">
			<section id="home_section">
				<?php if(isset($mainContent)){print $mainContent; }?>
			</section>
			<aside>
				<?php if(isset($sideContent)){print $sideContent; }?>
			</aside>
		</div>
		
		<!-- 	Form Functionality	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/question_form.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/animation.js"></script>
		
		<!-- 	CRUD Functionality	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/create.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/update.js"></script>
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/delete.js"></script>
	</body>
</html>