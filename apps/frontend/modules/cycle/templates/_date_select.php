<?php if (count($aDateList)): ?>
<p><b>Выберите даты проведения:</b></p>
	<p>
		<select>
			<?php foreach ($aDateList as $aItem): ?>
				<option value="<?php echo($aItem['cycle_date']); ?>" start="<?php echo($aItem['start']); ?>" finish="<?php echo($aItem['finish']); ?>"><?php echo($aItem['cycle_date']); ?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p><b>Или введите их, если нужных дат нет в списке:</b></p>
	<input type="date" name="start_input" value=""> - <input type="date" name="finish_input" value="">	
	
	<input type="hidden" name="start" value="">
	<input type="hidden" name="finish" value="">
<?php else: ?>
	<p><b>В базе данных нет дат для выбранного цикла. Введите их:</b></p>
	<input type="date" name="start_input" value=""> - <input type="date" name="finish_input" value="">
<?php endif; ?>