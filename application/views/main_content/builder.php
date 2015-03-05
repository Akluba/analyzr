<!-- Survey preview existing questions -->
<div class="container" id="builder_active_container">
	<h2>Builder: <strong><?php echo $title?></strong></h2>
	<!-- displaying each question for this survey -->
	<?php foreach($questions as $question): ; echo "\n"; ?>
		<article> 
			<!-- question title -->
			<div class="article_header">
				<h3><?php echo $question->questionText; ?></h3>
				<ul>
					<li><a href="#" data-id="<?php echo $question->questionId; ?>" class="js_question_edit">edit</a></li>
					<li><a href="#" data-id="<?php echo $question->questionId; ?>" class="js_question_delete">remove</a></li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			<div class="article_content">
			<?php
			// CHOICES
			$question_type = $question->questionType;
			echo '<table>';
			echo '<tbody class="choice_rows">';
			if($question_type != 3){
				foreach($answers as $answer){
					if($answer->questionId == $question->questionId){
						echo '<tr>';
						switch($question_type){
							// displaying answer type - RADIO 
							case 1:
								echo '<td>' .form_radio(array('name'=>$question->questionId, 'value'=>$answer->answerId));
								echo $answer->answerText .'</td>';
								break;
							// displaying answer type - CHECKBOX 
							case 2:
								echo '<td>' .form_checkbox(array('name'=>$question->questionId, 'value'=>$answer->answerId));
								echo $answer->answerText .'</td>';
								break;
							// displaying answer type - INPUT 	
							case 4:
								echo form_input(array('name'=>$question->questionId, 'class'=>'survey_input'));
								echo form_hidden($question->questionId . 'hidden', $answer->answerId);
								break;
							// displaying answer type - TEXTAREA 	
							case 5:
								echo form_textarea(array('name'=>$question->questionId, 'class'=>'survey_textarea'));
								echo form_hidden($question->questionId . 'hidden', $answer->answerId);
								break;
						}// end of switch statement
						echo '</tr>';
					}// end of if 
				}// end of foreach answer
			}else{
				$options = array();
				foreach($answers as $answer){
					if($answer->questionId == $question->questionId){
						$options[$answer->answerId] = $answer->answerText;
					}
				}
				// displaying answer type - DROPDOWN 
				echo form_dropdown($question->questionId, $options, '','class="form_select"');
			}// end if/else question type
			echo '</tbody>';
			echo '</table>';	
			?>
			</div>
		</article>
	<?php endforeach ?>
</div>
<!-- Confirm Survey Delete panel -->
<div id="confirm_remove" style="display: none;">
	<div id="confirmOverlay">
		<div id="confirmBox">
			<h1>Confirm Deleting Question</h1>
			<p>Are you sure you would like to delete this Question and all related content? This can not be undone.</p>
			<div id="confirmButtons">
				<a class="js_confirm_remove confirm_remove_btn" href="#">Confirm<span></span></a>
				<a class="js_cancel_remove cancel_remove_btn" href="#">Cancel<span></span></a>
			</div>
		</div>
	</div>
</div>