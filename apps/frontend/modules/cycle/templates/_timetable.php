<?php use_javascript('timetable.js') ?>
<?php $aRomanNumerals = array(1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI'); ?>
<?php $aHourCountVariants = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10); ?>
<?php $aHourRange = array('min' => 8, 'max' => 20); ?>
<?php $aMinuteRange = array('00', '10', '20', '30', '40', '50'); ?>

<p><table border="1" style="font-size: 1.2em" id="js_timetable">
	<tr>
		<td colspan="2" rowspan="2"></td>
		<?php foreach ($aDateHeaders as $aHeader): ?>
			<td colspan="<?php echo($aHeader['count']); ?>"><?php echo($aHeader['name']); ?></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<?php foreach ($aDates as $aDate): ?>
			<?php $bIsHoliday = (in_array($aDate['n'], array('6', '7'))) ? true : false; ?>
			<td <?php echo(($bIsHoliday) ? 'style="font-weight: bold"' : ''); ?>date="<?php echo($aDate['date']); ?>"><?php echo($aDate['day']); ?></td>
		<?php endforeach; ?>
	</tr>
	<?php for ($i = 1; $i < 6; $i++): ?>
		<tr class="js_lecture" class_number="<?php echo($i); ?>">
			<?php if ($i == 1): ?>
				<td rowspan="5">Лекции</td>
			<?php endif; ?>
			<td><?php echo($aRomanNumerals[$i]); ?></td>
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aLectures[$sDate][$i]); ?>
				<?php $bIsSubject = $bIsOccupied && $aLectures[$sDate][$i]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aLectures[$sDate][$i]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aLectures[$sDate][$i]['time_on']; ?>
				<td date="<?php echo($aDate['date']); ?>" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?><?php echo($bIsTelecomm ? ' js_telecomm' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aLectures[$sDate][$i]['item_id'] . '"' : ''); ?><?php echo($bTimeOn ? ' time_on_hour="' . $aLectures[$sDate][$i]['hour'] . '" time_on_minute="' . $aLectures[$sDate][$i]['minute'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<div style="font-family: monospace"><?php echo($aLectures[$sDate][$i]['subject_contraction']); ?> <input type="button" class="js_clear" value="X" style="color: red; font-size: 0.5em"></div>
						<div style="font-family: monospace"><i><?php echo($aLectures[$sDate][$i]['teacher_contraction']); ?></i> <input type="button" class="js_telecomm_mode" value="TELE" style="font-size: 0.5em"></div>
						<div>
							<select name="hour_count">
								<?php foreach ($aHourCountVariants as $iHourCount): ?>
									<option value="<?php echo($iHourCount); ?>"<?php echo(($iHourCount == $aLectures[$sDate][$i]['hour_count']) ? ' selected="selected"' : ''); ?>><?php echo($iHourCount); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div><?php echo($bTimeOn ? '<input type="time" class="js_time_on" value="' . $aLectures[$sDate][$i]['time_on'] . '">' : '<span class="ui-icon ui-icon-clock js_clock"></span>'); ?></div>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
	<?php endfor; ?>
	<tr>
		<td colspan="<?php echo(count($aDates) + 2); ?>">&nbsp;</td>
	</tr>
	<?php for ($i = 1; $i <= $iBrigadeCount; $i++): ?>
		<tr class="js_practice" brigade="<?php echo($i); ?>" session="1">
			<?php if ($i == 1) : ?>
				<td rowspan="<?php echo($iBrigadeCount * 3); ?>">Практика</td>
			<?php endif; ?>
			<td rowspan="2"><?php echo($aRomanNumerals[$i]); ?></td>
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aPractice[$sDate][$i][1]); ?>
				<?php $bIsSubject = $bIsOccupied && $aPractice[$sDate][$i][1]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aPractice[$sDate][$i][1]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aPractice[$sDate][$i][1]['time_on']; ?>
				<td date="<?php echo($aDate['date']); ?>" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?><?php echo($bIsTelecomm ? ' js_telecomm' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aPractice[$sDate][$i][1]['item_id'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<div style="font-family: monospace"><?php echo($aPractice[$sDate][$i][1]['subject_contraction']); ?> <input type="button" class="js_clear" value="X" style="color: red; font-size: 0.5em"></div>
						<div style="font-family: monospace"><i><?php echo($aPractice[$sDate][$i][1]['teacher_contraction']); ?></i> <input type="button" class="js_telecomm_mode" value="TELE" style="font-size: 0.5em"></div>
						<select name="hour_count">
							<?php foreach ($aHourCountVariants as $iHourCount): ?>
								<option value="<?php echo($iHourCount); ?>"<?php echo(($iHourCount == $aPractice[$sDate][$i][1]['hour_count']) ? ' selected="selected"' : ''); ?>><?php echo($iHourCount); ?></option>
							<?php endforeach; ?>
						</select>
						<div><?php echo($bTimeOn ? '<input type="time" class="js_time_on" value="' . $aPractice[$sDate][$i][1]['time_on'] . '">' : '<span class="ui-icon ui-icon-clock js_clock"></span>'); ?></div>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
		<tr class="js_practice" brigade="<?php echo($i); ?>" session="2">
			<?php foreach ($aDates as $aDate): ?>
				<?php $sDate = $aDate['date']; ?>
				<?php $bIsOccupied = isset($aPractice[$sDate][$i][2]); ?>
				<?php $bIsSubject = $bIsOccupied && $aPractice[$sDate][$i][2]['is_subject']; ?>
				<?php $bIsTelecomm = $bIsOccupied && $aPractice[$sDate][$i][2]['is_telecommunication']; ?>
				<?php $bTimeOn = $bIsOccupied && $aPractice[$sDate][$i][2]['time_on']; ?>
				<td date="<?php echo($aDate['date']); ?>" class="js_active<?php echo($bOccupied ? ' js_occupied' : ''); ?><?php echo($bIsSubject ? ' js_subject' : ''); ?><?php echo($bIsTelecomm ? ' js_telecomm' : ''); ?>"<?php echo($bIsOccupied ? ' item_id="' . $aPractice[$sDate][$i][2]['item_id'] . '"' : ''); ?><?php echo($bIsTelecomm ? ' bgcolor="silver"' : ''); ?>>
					<?php if ($bIsOccupied): ?>
						<div style="font-family: monospace"><?php echo($aPractice[$sDate][$i][2]['subject_contraction']); ?> <input type="button" class="js_clear" value="X" style="color: red; font-size: 0.5em"></div>
						<div style="font-family: monospace"><i><?php echo($aPractice[$sDate][$i][2]['teacher_contraction']); ?></i> <input type="button" class="js_telecomm_mode" value="TELE" style="font-size: 0.5em"></div>
						<select name="hour_count">
							<?php foreach ($aHourCountVariants as $iHourCount): ?>
								<option value="<?php echo($iHourCount); ?>"<?php echo(($iHourCount == $aPractice[$sDate][$i][2]['hour_count']) ? ' selected="selected"' : ''); ?>><?php echo($iHourCount); ?></option>
							<?php endforeach; ?>
						</select>
						<div><?php echo($bTimeOn ? '<input type="time" class="js_time_on" value="' . $aPractice[$sDate][$i][2]['time_on'] . '">' : '<span class="ui-icon ui-icon-clock js_clock"></span>'); ?></div>
					<?php else: ?>&nbsp;<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
		<tr>
			<td colspan="<?php echo(count($aDates) + 1); ?>">&nbsp;</td>
		</tr>
	<?php endfor; ?>
</table></p>