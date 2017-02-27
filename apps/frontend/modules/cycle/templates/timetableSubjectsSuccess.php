<div align="right"><a href="<?php echo(url_for('@homepage')); ?>">Вернуться к выбору цикла</a></div>
<p style="font-size: 1.2em"><b><?php echo($sCycleName); ?> / <?php echo($sStart); ?> &mdash; <?php echo($sFinish); ?> / бригад: <?php echo($iBrigadeCount); ?><?php echo((isset($sTown) && $sTown) ? ' / ' . $sTown : ''); ?></b></p>
<?php include_partial('cycle/timetable_subjects', array('aSubjects' => $aSubjects, 'aTeachers' => $aTeachers, 'aActions' => $aActions)); ?>
<?php include_partial('cycle/hours', array('iHourCount' => $iHourCount, 'iFactHourCount' => $iFactHourCount)); ?>
<?php include_partial('cycle/timetable', array('aDates' => $aDates, 'iBrigadeCount' => $iBrigadeCount, 'aLectures' => $aLectures, 'aPractice' => $aPractice, 'aDateHeaders' => $aDateHeaders)); ?>
<table>
	<tr>
		<td>
			<form action="pdfDeputyDirector" method="post" target="_blank">
				<input type="hidden" name="timetable_id" value="<?php echo($iTimetableId); ?>">
				<input type="submit" value="Печать копии для зам. директора">
			</form>
		</td>
		<td>
			<form action="pdfDirector" method="post" target="_blank">
				<input type="hidden" name="timetable_id" value="<?php echo($iTimetableId); ?>">
				<input type="submit" value="Печать копии для руководителя ОПК">
			</form>
		</td>
	</tr>
</table>