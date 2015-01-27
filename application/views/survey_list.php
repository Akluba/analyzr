<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | Surveys</title>
	</head>
	<body>
		<header>
			<h1>Analyzr</h1>
			<span>
				<?php echo "<b>" .$user['username'] ."</b> \n"; ?>
				<a href="#">Create Survey</a>
				<a href="auth/logout">Logout</a>
			</span>
		</header>
		
		<section>
			<?php foreach ($survey as $item): ?>

			<?php echo "<div class='survey_item'> \n"; ?>
				<?php echo "<h2>" .$item->title ."</h2> \n"; ?>
				<?php echo "<h3><b>Created </b>" .$item->createdDate ."</h3> \n"; ?>
				<?php if($item->status == 1): ?><h3><b>Status </b> open </h3>
				<?php else: ?><h3><b>Status </b> closed </h3><?php endif; ?>		
				<a href="route/<?php echo $item->surveyId;?>">settings</a>
				<a href="route/<?php echo $item->surveyId;?>">survey</a>
				<a href="route/<?php echo $item->surveyId;?>">send</a>
				<a href="route/<?php echo $item->surveyId;?>">results</a>
				<a href="route/<?php echo $item->surveyId;?>">delete</a>
			<?php echo "</div>"; ?>
			
			<?php endforeach ?>
		</section>
	</body>
</html>