<div class="container" id="analyze_individual">
	<?php
	echo '<h2>Analyze-individual: <strong>' .$title .'</strong></h2>';

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
				echo '<tbody class="analyze_table">';
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
									
									echo '<tr>';
										echo '<td>' .$answer->answerText ;
										foreach($responses as $response){
										if($answer->answerId == $response->answerId){	
												echo '<div id="recipient_choice"></div>';	
											}
										}
										echo '</td>';	
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