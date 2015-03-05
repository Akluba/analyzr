<div class="container" id="settings_active_container">
	<h2>Settings: <strong><?php echo $title?></strong></h2>
	<!-- Update survey TITLE -->
	<article>
		<div class="article_header">
			<h3>Survey Title</h3>
			<div id="title_message" class="in-head_error_message"></div>
		</div>
		<div class="article_content">
			<p class="settings_text">The survey title appears in multiple areas of Analyzr. It is presented to those participating in your survey, as well as to inform you to which survey you are currently working in. You may update the title at any time.</p>
			<?php
				// OPEN FORM
				echo form_open('#', array('id'=>'title_form'))."\n";
					// SURVEY ID -- hidden input 	
					echo form_hidden('survey_id', $survey_id);
					// TITLE LABEL
					echo form_label('Title: ') ."\n";
					// TITLE INPUT
					echo form_input(array('class' => 'form_input', 'value' => $title, 'name' => 'updated_title')) ."\n";
					// SUBMIT BUTTON
					echo form_submit(array('type'=>'submit','class'=>'update_btn js_button_change','value'=>'Update'))."\n";
				// CLOSE FORM
				echo form_close()."\n";
			?>
		</div>
	</article>
	<!-- Update survey STATUS -->
	<article>
		<div class="article_header">
			<h3>Survey Status</h3>
			<div id="status_message" class="in-head_error_message"></div>
		</div>
		<div class="article_content">
			<p class="settings_text">The survey status enables you to control responses to your survey. While open, visitors to your survey will be able to submit their responses. Once closed, those trying to access the survey will be notified that the survey is no longer available. This provides more accurate data when the time comes to analyze your survey's responses.</p>
			<?php
				// OPEN FORM
				echo form_open('#', array('id'=>'status_form'))."\n";
					// SURVEY ID -- hidden input 	
					echo form_hidden('survey_id', $survey_id);
					// STATUS LABEL
					echo form_label('Status: ') ."\n";
					// STATUS SELECT
					echo form_dropdown('status_update',array(1 => 'Open', 0 => 'Closed'), $status,'class="form_select"');
					// SUBMIT BUTTON
					echo form_submit(array('type'=>'submit','id'=>'js_update_status_btn','class'=>'update_btn','value'=>'Update'))."\n";
				// CLOSE FORM
				echo form_close()."\n";
			?>
		</div>
	</article>
</div>