<div class="container" id="send_active_container">
	<h2>Send: <strong><?php echo $title?></strong></h2>
	<?php
	if(empty($sent)){
		echo '<h3 class="empty_message">Is your survey built and ready to be sent out? Invite participants via email using the <strong>Survey Sendr.</strong> <span class="icon" data-icon="&#xe032;"></span></h3>';
	}else{
	?>
	<table>
		<thead>
			<tr>
				<th>Email</th>
				<th>Sent</th>
				<th>Responded</th>
			</tr>
		</thead>
		<tbody class="send_recipients_table">
			<?php foreach ($sent as $sent_info): ?>
			<tr>
				<td><?php echo $sent_info->email; ?></td>
				<td><?php echo $sent_info->sentDate; ?></td>
				<td><?php echo $sent_info->respondDate; ?> <?php if($sent_info->respondDate == NULL) echo "&#45;"; ?> </td>
			</tr>
			<tr class="spacer"><td></td></tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?php
	}
	?>
	
</div>



