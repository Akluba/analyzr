<h2>Builder: <strong><?php echo $title?></strong></h2>
<!-- displaying each question for this survey -->
<?php foreach($questions as $question): ; echo "\n"; ?>
	<article> 
		<!-- question title -->
		<h3><?php echo $question->questionText; ?></h3>
		<!-- if a select element place opening select tag -->
		<?php if($question->questionType == 3): ?>
			<select name="<?php echo $question->questionId; ?>">
		<?php endif ?>
			<!-- displaying each answer -->
			<?php foreach($answers as $answer): ?>
				<!-- displaying correct answer set to question -->
				<?php if($answer->questionId == $question->questionId): ?>
					<!-- displaying answer type - RADIO -->
					<?php if($question->questionType == 1): ?>
						<input type="radio" name="<?php echo $question->questionId;?>" value="<?php echo $answer->answerText?>"><?php echo $answer->answerText;?>
					<!-- displaying answer type - CHECKBOX -->
					<?php elseif($question->questionType == 2): ?>
						<input type="checkbox" name="<?php echo $question->questionId;?>" value="<?php echo $answer->answerText?>"><?php echo $answer->answerText;?>
					<!-- displaying answer type - DROPDOWN -->
					<?php elseif($question->questionType == 3): ?>
						<option value="<?php echo $answer->answerText?>"><?php echo $answer->answerText?></option>
					<!-- displaying answer type - INPUT -->
					<?php elseif($question->questionType == 4): ?>
						<input type="text" name="<?php echo $question->questionId;?>">
					<!-- displaying answer type - COMMENT -->
					<?php elseif($question->questionType == 5): ?>
						<textarea name="<?php echo $question->questionId;?>"></textarea> 
					<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
		<!-- if a select element place closing select tag -->
		<?php if($question->questionType == 3): ?>
			</select>
		<?php endif; echo "\n"; ?>
	</article>
<?php endforeach ?>