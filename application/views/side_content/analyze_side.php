<div class="side_container">
	<h2><strong>Choose Analyzr Type</strong></h2>
	<ul>
		<li><a href="#" id="js_view_overview">Overview</a></li>
		<li><a href="#" id="js_view_individual">Individual</a></li>
	</ul>
	<?php foreach($recipients as $recipient): ?>
		<div class="js_individual_recipient" data-id="<?php echo $recipient->recipientId; ?>">
			<?php echo $recipient->email; ?>
			<?php echo $recipient->respondDate; ?>
		</div>
	<?php endforeach ?>
</div>