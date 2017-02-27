<?php $aRomanNumerals = array(1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI'); ?>
<table border="1" bordercolor="black" cellspacing="0" align="center">
	<tr>
		<td colspan="2" rowspan="2"></td>
		<?php foreach ($aMonthHeaders as $aHeader): ?>
			<td colspan="<?php echo($aHeader['count']); ?>" style="font-size: 0.8em"><?php echo($aHeader['name']); ?></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach ($aDates as $aDate): ?>
			<td align="center" style="font-size: 0.8em; width: 2.4em" date="<?php echo($aDate['date']); ?>"><?php echo($aDate['day']); ?></td>
		<?php endforeach; ?>
	</tr>
	<?php for ($i = 1; $i <= $iBrigadeCount; $i++): ?>
		<tr brigade="<?php echo($i); ?>" session="1">
			<?php if ($i == 1) : ?>
				<td rowspan="<?php echo($iBrigadeCount * 2); ?>" style="font-size: 0.8em">Практика</td>
			<?php endif; ?>
			<td rowspan="2" align="center" style="font-size: 0.8em"><?php echo($aRomanNumerals[$i]); ?></td>
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aPractice[$sDate][$i][1]); ?>
				<?php $bIsSubject = $bIsOccupied && $aPractice[$sDate][$i][1]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aPractice[$sDate][$i][1]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aPractice[$sDate][$i][1]['time_on']; ?>
				<td valign="top" date="<?php echo($aDate['date']); ?>" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aPractice[$sDate][$i][1]['item_id'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<?php echo($bTimeOn ? '<div style="font-size: 0.6em">' . $aPractice[$sDate][$i][1]['time_on'] . '</div>' : ''); ?>
						<div style="font-size: 0.8em"><?php echo($aPractice[$sDate][$i][1]['subject_contraction']); ?></div>
						<div style="font-size: 0.8em"><i><?php echo($aPractice[$sDate][$i][1]['teacher_contraction']); ?></i></div>
						<?php echo(($aPractice[$sDate][$i][1]['hour_count'] != 0) ? '<div style="font-size: 0.6em">' . $aPractice[$sDate][$i][1]['hour_count'] . ' ч.</div>' : ''); ?>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
		<tr brigade="<?php echo($i); ?>" session="2">
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aPractice[$sDate][$i][2]); ?>
				<?php $bIsSubject = $bIsOccupied && $aPractice[$sDate][$i][2]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aPractice[$sDate][$i][2]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aPractice[$sDate][$i][2]['time_on']; ?>
				<td valign="top" date="<?php echo($aDate['date']); ?>" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aPractice[$sDate][$i][2]['item_id'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<?php echo($bTimeOn ? '<div style="font-size: 0.6em">' . $aPractice[$sDate][$i][2]['time_on'] . '</div>' : ''); ?>
						<div style="font-size: 0.8em"><?php echo($aPractice[$sDate][$i][2]['subject_contraction']); ?></div>
						<div style="font-size: 0.8em"><i><?php echo($aPractice[$sDate][$i][2]['teacher_contraction']); ?></i></div>
						<?php echo(($aPractice[$sDate][$i][2]['hour_count'] != 0) ? '<div style="font-size: 0.6em">' . $aPractice[$sDate][$i][2]['hour_count'] . ' ч.</div>' : ''); ?>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
	<?php endfor; ?>
</table>
<br>