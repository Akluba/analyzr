<h2>Settings: <strong><?php echo $title?></strong></h2>

<h3>Survey Title</h3>
<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae metus pulvinar, porta lectus quis, porta diam. Praesent varius semper turpis, sed ullamcorper nulla convallis non. Quisque eget suscipit mi. Duis nunc lorem, scelerisque sed ante vel, tempor placerat orci.</p>
<?php
	echo form_open('survey/update_title/'.$survey_id)."\n";
		echo form_label('Title : ') ."\n";
		$data = array(
		'value' => $title,
		'name' => 'updated_title'
		);
		echo form_input($data) ."\n";
		echo form_submit('submit', 'Update')."\n";
	echo form_close()."\n";
?>


<h3>Survey Status</h3>
<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vitae metus pulvinar, porta lectus quis, porta diam. Praesent varius semper turpis, sed ullamcorper nulla convallis non. Quisque eget suscipit mi. Duis nunc lorem, scelerisque sed ante vel, tempor placerat orci.</p>
<?php
	echo form_open('survey/update_status/'.$survey_id)."\n";
	echo form_label('Status : ') ."\n";
?>
<select name="status_update">
<?php if($status == 1): ?>
	<option value="1" <?php echo set_select('status_update', 1, TRUE); ?> >Open</option>
	<option value="0" <?php echo set_select('status_update', 0); ?> >Closed</option>
<?php else: ?>
	<option value="1" <?php echo set_select('status_update', 1); ?> >Open</option>
	<option value="0" <?php echo set_select('status_update', 0, TRUE); ?> >Closed</option>
<?php endif ?>
</select>
<?php
	echo form_submit('submit', 'Update')."\n";
	echo form_close()."\n";
?>