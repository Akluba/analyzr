<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Analyzr | Surveys</title>
	</head>
	<body>
		<header>
			<h1>Analyzr</h1>
			<ul>
				<li><?php echo "<strong>" .$user['username'] ."</strong>"; ?></li>
				<li><a href="/analyzr/home/add_survey">Create Survey</a></li>
				<li><a href="auth/logout">Logout</a></li>
			</ul>
		</header>
		<section id="surveys">
<?php foreach ($survey as $item): ?>
			<article>
				<h2><?php echo $item->title; ?></h2>
				<h3>created <?php echo $item->createdDate; ?></h3>
<?php if($item->status == 1): ?>
				<h3>Status open</h3><?php else: ?>
				<h3>Status closed</h3><?php endif ?>		
				<a href="survey/settings/<?php echo $item->surveyId;?>">settings</a>
				<a href="route/<?php echo $item->surveyId;?>">survey</a>
				<a href="route/<?php echo $item->surveyId;?>">send</a>
				<a href="route/<?php echo $item->surveyId;?>">results</a>
				<a href="route/<?php echo $item->surveyId;?>">delete</a>
			</article>
<?php endforeach ?>
		</section>
	</body>
</html>