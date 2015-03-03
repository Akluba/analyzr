<div class="container">
	<h2>Survey Home</strong></h2>
	<article id="new_survey">
		<div class="article_header">
			<h3>Create a new survey</h3>
			<div id="message" class="in-head_error_message"></div>
		</div>
		<div id="new_survey_content">
			<!-- form for creating new survey !look into formatting source code! -->
			<?php
				// OPEN FORM
				echo form_open('#', array('id'=>'survey_form')) ."\n";
				// SURVEY ID -- hidden input 	
				echo form_hidden('user_id', $user['userId']);
				// SURVEY NAME -- text input
				echo form_label('Survey Name :') ."\n";
				echo form_input(array('name'=>'survey_name','class'=>'form_input','id'=>'create_survey_input')) ."\n";
				// SUBMIT FORM
				echo form_submit(array('type'=>'submit','class'=>'update_btn','value'=>'Create Survey'))."\n";
				// CLOSE FORN
				echo form_close()."\n";
			?>
		</div>
	</article>
	
	<!-- existing surveys and their possible functions -->
	<?php foreach ($survey as $item): ?>
		<article class="home_existing_survey">
			<div class="home_existing_info">
				<h4><?php echo $item->title; ?></h4>
				<h5>created <?php echo $item->createdDate; ?></h5>
			<?php if($item->status == 1): ?>
				<h5>Status open</h5>
			<?php else: ?>
				<h5>Status closed</h5>
			<?php endif ?>
			</div>
			<ul>
				<li><a href="survey_settings/<?php echo $item->surveyId;?>"><div class="icon" data-icon="&#xe027;"></div>Settings</a></li>
				<li><a href="survey_builder/<?php echo $item->surveyId;?>"><div class="icon" data-icon="&#xe037;"></div>Build</a></li>
				<li><a href="survey_send/<?php echo $item->surveyId;?>"><div class="icon" data-icon="&#xe048;"></div>Send</a></li>
				<li><a href="survey_analyze/<?php echo $item->surveyId;?>"><div class="icon" data-icon="&#xe028;"></div>Analyze</a></li>
			</ul>
			<div style="clear:both;"></div> 
		</article>
	<?php endforeach ?>
</div>
