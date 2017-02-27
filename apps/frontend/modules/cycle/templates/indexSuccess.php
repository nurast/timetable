<?php use_javascript('date.js') ?>

<form action="cycle/subjects" method="post">
	<p><b>Выберите цикл:</b></p>
	<p>
		<select id="js_cycle_select" name="cycle_id">
			<?php foreach ($aCycles as $aCycle): ?>
			<option value="<?php echo($aCycle['id']); ?>"><?php echo($aCycle['cycle_name']); ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<div id="js_date_select">
		<?php include_partial('cycle/date_select', array('aDateList' => $aDateList)); ?>
	</div>
	
	<p><b>Количество бригад:</b></p>
	<p><input type="text" name="brigade_count" required></p>

	<p><b>Количество часов:</b></p>
	<p><input type="text" name="hour_count" placeholder="0"></p>
	
	<p><b>Город:</b></p>
	<p><input type="text" name="town" placeholder="Оренбург"></p>
	
	<p><input type="submit" value="Далее"></p>
</form>