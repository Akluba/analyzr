<h2>Builder: <strong><?php echo $title?></strong></h2>


<?php foreach ($question as $item): ?>
	<h3><?php echo $item->questionText; ?></h3> 
<?php endforeach ?>