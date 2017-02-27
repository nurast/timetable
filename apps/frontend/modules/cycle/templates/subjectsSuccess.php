<div align="right"><a href="<?php echo(url_for('@homepage')); ?>">Вернуться к выбору цикла</a></div>
<form action="subjects" method="post">
	<input type="hidden" name="cycle_id" value="<?php echo($iCycleId); ?>">
	<input type="hidden" name="start" value="<?php echo($sStart); ?>">
	<input type="hidden" name="finish" value="<?php echo($sFinish); ?>">
	<input type="hidden" name="brigade_count" value="<?php echo($iBrigadeCount); ?>">
	<input type="hidden" name="town" value="<?php echo($sTown); ?>">
	<input type="hidden" name="timetable_id" value="<?php echo($iTimetableId); ?>">	
	
	<p style="font-size: 1.2em"><b><?php echo($sCycleName); ?> / <?php echo($sStart); ?> &mdash; <?php echo($sFinish); ?> / бригад: <?php echo($iBrigadeCount); ?><?php echo((isset($sTown) && $sTown) ? ' / ' . $sTown : ''); ?></b></p>
		
	<?php include_partial('cycle/plan_subjects', array('aSubjects' => $aSubjects)); ?>

	<p><input type="submit" value="Сохранить"></p>
</form>