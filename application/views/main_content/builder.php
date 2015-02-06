<h2>Builder: <strong><?php echo $title?></strong></h2>

<?php foreach($questions as $question): ; echo "\n"; ?>
			<article> 
				<h3><?php echo $question->questionText; ?></h3>
	<?php if($question->questionType == 5): ?>
		<select name="<?php echo $question->questionId; ?>">
	<?php endif ?>
	<?php foreach($answers as $answer): ?>
	<?php if($answer->questionId == $question->questionId): ?>

	<?php if($question->questionType == 1): ?>
			<input type="radio" name="<?php echo $question->questionId;?>" value="<?php echo $answer->answerText?>"><?php echo $answer->answerText;?>
	<?php elseif($question->questionType == 2): ?>
			<input type="checkbox" name="<?php echo $question->questionId;?>" value="<?php echo $answer->answerText?>"><?php echo $answer->answerText;?>
	<?php elseif($question->questionType == 3): ?>
			<input type="text" name="<?php echo $question->questionId;?>">
	<?php elseif($question->questionType == 4): ?>
			<textarea name="<?php echo $question->questionId;?>"></textarea> 
	<?php elseif($question->questionType == 5): ?>
			<option value="<?php echo $answer->answerText?>"><?php echo $answer->answerText?></option>
	<?php endif ?>
	<?php endif ?>
	<?php endforeach ?>
	<?php if($question->questionType == 5): ?>
		</select>
	<?php endif; echo "\n"; ?>
			</article>
<?php endforeach ?>