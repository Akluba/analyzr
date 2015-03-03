<div class="container" id="send_active_container">
	<h2>Send: <strong><?php echo $title?></strong></h2>
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
	
</div>



