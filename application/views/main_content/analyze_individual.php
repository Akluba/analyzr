<div class="container" id="analyze_individual">
	<?php
	echo '<h2>Builder-individual: <strong>' .$title .'</strong></h2>';

	foreach($questions as $question){
		echo '<article>';
			// TITLE 
			echo '<div class="article_header">';
				echo '<h3>' .$question->questionText .'</h3>';
			echo '</div>';
			echo '<div class="article_content">';
			// REQUIRED
			if($question->questionRequire == 1){
				echo '<p>&#42; answer required</p>';
			}
			// CHOICES
			$question_type = $question->questionType;
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
								foreach($responses as $response){
									if($answer->answerId == $response->answerId){	
										echo '&#x2713;';	
									}
								}
								echo $answer->answerText;	
						}// end of switch	
					}// end of if 
				}// end of foreach answer
			echo '</div>';
		echo '</article>';
	}// end of foreach question
	
	?>
</div>