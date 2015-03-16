<div class="side_container">
	<h2><strong>Choose Analyzr Type</strong></h2>
	<ul id="analyze_type_ul">
		<li><a href="#" id="js_view_overview">Overview</a></li>
		<li>&#124;</li>
		<li><a href="#" id="js_view_individual">Individual</a></li>
	</ul>
	
	<?php 
		if($recipients == null){
			echo '<div id="restrict_action">';
			echo '<h3 class="empty_message">Analyzr options will become available when responses are received.</h3>';
			echo '<a class="empty_btn" href="../survey_send/' .$survey_id .'">Send Survey</a>';
			echo '</div>';
		}	
	?>
	
	<?php foreach($recipients as $recipient): ?>
		<div class="js_individual_recipient recipient_item" data-id="<?php echo $recipient->recipientId; ?>">
			<p><?php echo $recipient->email; ?></p>
			<p>Responded: <?php echo $recipient->respondDate; ?></p>
		</div>
	<?php endforeach ?>
</div>