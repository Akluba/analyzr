<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | <?php echo $pageTitle;?></title>
	</head>
	<body>
		<header>
			<?php if(isset($headerContent)){print $headerContent; }?>
		</header>
		<nav>
			<?php if(isset($navContent)){print $navContent; }?>
		</nav>
		<section>
			<?php if(isset($mainContent)){print $mainContent; }?>
		</section>
		<aside>
			<?php if(isset($sideContent)){print $sideContent; }?>
		</aside>
	</body>
</html>