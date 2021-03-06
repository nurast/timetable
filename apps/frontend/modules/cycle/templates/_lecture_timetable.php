<?php $aRomanNumerals = array(1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI'); ?>
<br>
<table align="center" style="border-collapse: collapse; border: 1px solid black">
	<tr>
		<td colspan="2" rowspan="2" style="border: 1px solid black"></td>
		<?php foreach ($aMonthHeaders as $aHeader): ?>
			<td colspan="<?php echo($aHeader['count']); ?>" style="font-size: 0.8em; border: 1px solid black"><?php echo($aHeader['name']); ?></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach ($aDates as $aDate): ?>
			<?php $bIsHoliday = (in_array($aDate['n'], array('6', '7'))) ? true : false; ?>
			<td align="center" style="font-size: 0.8em; width: 2.4em; border: 1px solid black<?php echo(($bIsHoliday) ? '; font-weight: bold;' : ''); ?>" date="<?php echo($aDate['date']); ?>"><?php echo($aDate['day']); ?></td>
		<?php endforeach; ?>
	</tr>
	<?php for ($i = 1; $i < 6; $i++): ?>
		<tr class_number="<?php echo($i); ?>">
			<?php if ($i == 1): ?>
				<td rowspan="5" style="font-size: 0.8em; border: 1px solid black">Лекции</td>
			<?php endif; ?>
			<td align="center" style="font-size: 0.8em; border: 1px solid black"><?php echo($aRomanNumerals[$i]); ?></td>
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aLectures[$sDate][$i]); ?>
				<?php $bIsSubject = $bIsOccupied && $aLectures[$sDate][$i]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aLectures[$sDate][$i]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aLectures[$sDate][$i]['time_on']; ?>
			<td valign="top" date="<?php echo($aDate['date']); ?>" style="border: 1px solid black" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aLectures[$sDate][$i]['item_id'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<?php echo($bTimeOn ? '<div style="font-size: 0.6em">' . $aLectures[$sDate][$i]['time_on'] . '</div>' : ''); ?>
						<div style="font-size: 0.8em"><?php echo($aLectures[$sDate][$i]['subject_contraction']); ?></div>
						<div style="font-size: 0.8em"><i><?php echo($aLectures[$sDate][$i]['teacher_contraction']); ?></i></div>
								<?php echo(($aLectures[$sDate][$i]['hour_count'] != 2) ? '<div style="font-size: 0.6em">' . $aLectures[$sDate][$i]['hour_count'] . ' ч.</div>' : ''); ?>
							<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
	<?php endfor; ?>
</table>
<br>