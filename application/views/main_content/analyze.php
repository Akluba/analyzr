<div class="container" id="analyze_overview">
	<?php
	echo '<h2>Analyze-overview: <strong>' .$title .'</strong></h2>';
	
	if(empty($questions)){
		echo '<h3 class="empty_message">You have nothing to analyze! First you must create your survey and send it out.</h3>';
	}
	$carousel_input_id = 0;
	foreach($questions as $question){
		echo '<article>';
			// TITLE 
			echo '<div class="article_header">';
				echo '<h3>' .$question->questionText .'</h3>';
				// REQUIRED
				if($question->questionRequire == 1){
					echo '<p class="answer_required">&#42; answer required</p>';
				}
			echo '</div>';
			echo '<div class="article_content">';
			// CHOICES
			$question_type = $question->questionType;
			echo '<table >';
				echo '<tbody class="analyze_table choice_rows">';
					foreach($answers as $answer){
						if($answer->questionId == $question->questionId){
							switch($question_type){
								case 4:
									echo '<div class="swipe_input_container" id="' .$carousel_input_id .'">';
										echo '<div class="swipe_input">';
											echo '<div class="swipe_input_carousel" id="' .$carousel_input_id .'">';
											echo '<ul>';
											foreach($responses as $response){
												if($answer->answerId == $response->answerId){
													echo '<li><p class="swipe_response">' .$response->responseText .'</p></li>';
												}
											}
											echo '</ul>';
											echo '</div>';
										echo '</div>';
										echo '<div class="swipe_controls">';
											echo '<span class="current_num"></span>';
											echo '<span class="prev icon" data-icon="&#xe018;"></span>';  
											echo '<span class="next ' .$carousel_input_id .' icon" data-icon="&#xe015;"></span>';
										echo '</div>';
										echo '<div style="clear:both">';
									echo '</div>';
									break;
								case 5: 
									foreach($responses as $response){
										if($answer->answerId == $response->answerId){
											echo $response->responseText;
										}
									}
									break;
								default:
									$total = 0;
									$count = 0;
									foreach($responses as $response){
										if ($question->questionId == $response->questionId) $total++;
										if ($answer->answerId == $response->answerId) $count++;
									}
									$percent = ($count > 0 ? $count / $total : 0 );
									echo '<tr>';
										echo '<td width="50%">' .$answer->answerText .'</td>';
										echo '<td width="35%"><meter max="' .$total .'" value="' .$count .'"></meter></td>';
										echo '<td width="10%">' .round((float)$percent * 100 ) .'%' .'</td>';
										echo '<td width="5%">' .$count .'</td>';
									echo '</tr>';
							}// end of switch	
						}// end of if 
					}// end of foreach answer
					$carousel_input_id ++;
					echo '<tbody>';
			echo '</table>';
				
			echo '</div>';
		echo '</article>';
	}// end of foreach question
	
	
	?>
</div>