<div id="container">
	<h2>Send: <strong><?php echo $title?></strong></h2>
	<div class="article_header">
		<h3>Email</h3>
		<h3>Sent</h3>
		<h3>Responded</h3>
		<div id="title_message"></div>
	</div>
	<?php foreach ($sent as $sent_info): ?>
	<article>
	<div class="article_content">
		<h4><?php echo $sent_info->email; ?></h4>
		<h5><?php echo $sent_info->sentDate; ?></h5>
		<h5><?php echo $sent_info->respondDate; ?></h5>
		<?php if($sent_info->respondDate == NULL) echo "&#45;"; ?>
	</div>
	</article>
	<?php endforeach ?>
</div>