<h2>Create a new survey</h2>
<!-- form for creating new survey !look into formatting source code! -->
<?php
	echo form_open('home/add_survey')."\n";

	echo form_label('Survey Name :') ."\n";
	echo form_input('survey_name') ."\n";
	
	echo form_submit('submit', 'Create Survey')."\n";
	
	echo form_close()."\n";
?>
			<!-- existing surveys and their possible functions -->
<?php foreach ($survey as $item): ?>
			<article>
				<h3><?php echo $item->title; ?></h3>
				<h4>created <?php echo $item->createdDate; ?></h4>
<?php if($item->status == 1): ?>
				<h4>Status open</h4><?php else: ?>
				<h4>Status closed</h4><?php endif ?>		
				<a href="survey/settings/<?php echo $item->surveyId;?>">settings</a>
				<a href="route/<?php echo $item->surveyId;?>">survey</a>
				<a href="route/<?php echo $item->surveyId;?>">send</a>
				<a href="route/<?php echo $item->surveyId;?>">results</a>
			</article>
<?php endforeach ?>

