<div class="container">
<?php 
	echo '<h2 id="survey_title">Survey: <strong>' .$surveyTitle .'</strong></h2>';
	// HIDDEN INPUTS
	$hidden = array('recipient_id'=>$recipient[0]->recipientId,'survey_id'=>$recipient[0]->surveyId);
	// FORM OPEN
	echo form_open('#',array('id'=>'survey_response'),$hidden);
	foreach($questions as $question){
		echo '<article class="survey_item">';
			// TITLE 
			echo '<div class="article_header">';
				echo '<h3 class="question_title">' .$question->questionText .'</h3>';
				// REQUIRED
				if($question->questionRequire == 1){
					echo '<p class="answer_required">&#42; answer required</p>';
				}
			echo '<div style="clear:both"></div>';
			echo '</div>';
			echo '<div class="article_content">';
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
								echo '<td>' .form_checkbox(array('name'=>$question->questionId.'[]', 'value'=>$answer->answerId));
								echo $answer->answerText .'</td>';
								break;
							// displaying answer type - INPUT 	
							case 4:
								echo form_input(array('name'=>$question->questionId, 'class'=>'survey_input'));
								echo form_hidden($question->questionId . 'hidden', $answer->answerId);
								break;
							// displaying answer type - TEXTAREA 	
							case 5:
								echo form_textarea(array('name'=>$question->questionId,'class'=>'survey_textarea'));
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
			}
			echo '</table>';
			echo '</tbody>';
			echo '</div>';
		echo '</article>';
	}// end of foreach question
	
	
	
	// SUBMIT BUTTON
	echo form_submit(array('type'=>'submit','class'=>'submit_btn','value'=>'Submit Survey'));
	// FORM CLOSE
	echo form_close();
?>
</div>	

<!-- Missing answer  -->
<div id="confirm_remove" style="display: none;">
	<div id="confirmOverlay">
		<div id="confirmBox">
			<h1>Survey Incomplete</h1>
			<p id="required_error"></p>
			<div id="confirmButtons">
				<a class="js_close_window confirm_remove_btn" href="#">Ok<span></span></a>
			</div>
		</div>
	</div>
</div>
	
	