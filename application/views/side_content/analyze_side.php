<div class="side_container">
	<h2><strong>Choose Analyzr Type</strong></h2>
	<ul id="analyze_type_ul">
		<li><a href="#" id="js_view_overview">Overview</a></li>
		<li>&#124;</li>
		<li><a href="#" id="js_view_individual">Individual</a></li>
	</ul>
	<?php foreach($recipients as $recipient): ?>
		<div class="js_individual_recipient recipient_item" data-id="<?php echo $recipient->recipientId; ?>">
			<p><?php echo $recipient->email; ?></p>
			<p>Responded: <?php echo $recipient->respondDate; ?></p>
		</div>
	<?php endforeach ?>
</div>