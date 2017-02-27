<?php foreach ($aContractions as $aContraction): ?>
	<b><?php echo($aContraction['subject_contraction']); ?> <i><?php echo($aContraction['teacher_contraction']); ?></i></b> <?php echo(trim($aContraction['subject_name'])); ?>. <i><?php echo(trim($aContraction['teacher_name'])); ?></i>
	<br>
<?php endforeach; ?>
<?php if ($iTelecommCount): ?>
	Серым цветом обозначены занятия, проводимые с использованием телекоммуникационных технологий.
<?php endif; ?>
