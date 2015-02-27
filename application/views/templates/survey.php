<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		
<!-- 		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css"> -->
<!-- 		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/confirm.css"> -->
		
		<!-- 	jQuery	 -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	</head>
	<body>
		<header>
			<?php if(isset($headerContent)){print $headerContent; }?>
		</header>
		<section>
			<?php if(isset($surveyTitle)){print $surveyTitle; }?>
			<?php if(isset($surveyBody)){print $surveyBody; }?>
		</section>
		
		<!-- 	SUBMITTING RESPONSE	 -->
		<script type="text/javascript" src="<?php echo asset_url();?>js/ajax/response.js"></script>
	</body>
</html>