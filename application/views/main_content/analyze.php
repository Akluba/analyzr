<div class="container" id="analyze_overview">
	<?php
	echo '<h2>Analyze-overview: <strong>' .$title .'</strong></h2>';

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
									foreach($responses as $response){
										if($answer->answerId == $response->answerId){
											echo $response->responseText;
										}
									}
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
				echo '<tbody>';
			echo '</table>';
			echo '</div>';
		echo '</article>';
	}// end of foreach question
	
	?>
</div>