<!-- Delete Survey -->
<div class="side_container">
	<h2><strong>Delete Survey</strong></h2>
	<p>Text goes here..</p>
	<a class="submit_btn js_survey_delete" id="delete_btn" href="#" data-id="<?php echo $survey_id; ?>">Delete</a>
</div>
<!-- Confirm Survey Delete panel -->
<div id="confirm_remove" style="display: none;">
	<div id="confirmOverlay">
		<div id="confirmBox">
			<h1>Remove Survey</h1>
			<p>Description of what is about to happen</p>
			<div id="confirmButtons">
				<a class="js_confirm_remove" href="#">Yes<span></span></a>
				<a class="js_cancel_remove" href="#">No<span></span></a>
			</div>
		</div>
	</div>
</div>