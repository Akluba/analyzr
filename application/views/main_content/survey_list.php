<div id="container">
	<article>
		<div class="article_header">
			<h3>Create a new survey</h3>
			<?php
				if (isset($message_display)) {
				echo "<div class='message'>";
				echo $message_display;
				echo "</div>";
				}
				echo "\n"
			?>
		</div>
		
		<!-- form for creating new survey !look into formatting source code! -->
		<?php
			echo form_open('home/add_survey')."\n";
			
			echo form_label('Survey Name :') ."\n";
			echo form_input('survey_name') ."\n";
			
			echo form_submit('submit', 'Create Survey')."\n";
			
			echo form_close()."\n";
		?>
	</article>
	
	<!-- existing surveys and their possible functions -->
	<?php foreach ($survey as $item): ?>
	<article>
		<h4><?php echo $item->title; ?></h4>
		<h5>created <?php echo $item->createdDate; ?></h5>
	<?php if($item->status == 1): ?>
		<h5>Status open</h5><?php else: ?>
		<h5>Status closed</h5><?php endif ?>		
		<a href="survey/settings/<?php echo $item->surveyId;?>">settings</a>
		<a href="survey/builder/<?php echo $item->surveyId;?>">builder</a>
		<a href="route/<?php echo $item->surveyId;?>">send</a>
		<a href="route/<?php echo $item->surveyId;?>">results</a>
	</article>
	<?php endforeach ?>
</div>
