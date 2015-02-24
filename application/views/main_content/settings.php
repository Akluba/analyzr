<div id="container">
	<h2>Settings: <strong><?php echo $title?></strong></h2>
	<!-- Update survey TITLE -->
	<article>
		<div class="article_header">
			<h3>Survey Title</h3>
			<div id="title_message"></div>
		</div>
		<div class="article_content">
			<p>Text goes here..</p>
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
					echo form_submit(array('type'=>'submit','class'=>'update_btn','value'=>'Update'))."\n";
				// CLOSE FORM
				echo form_close()."\n";
			?>
		</div>
	</article>
	<!-- Update survey STATUS -->
	<article>
		<div class="article_header">
			<h3>Survey Status</h3>
			<div id="status_message"></div>
		</div>
		<div class="article_content">
			<p>Text goes here..</p>
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
					echo form_submit(array('type'=>'submit','class'=>'update_btn','value'=>'Update'))."\n";
				// CLOSE FORM
				echo form_close()."\n";
			?>
		</div>
	</article>
</div>