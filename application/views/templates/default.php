<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
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
	</body>
</html>