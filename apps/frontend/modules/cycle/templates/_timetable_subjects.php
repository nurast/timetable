<?php use_javascript('subjects.js') ?>

<p><table id="js_cycle_subject">
	<tr>
		<th align="left">Предмет</th>
		<th align="left">Обозн.</th>
		<th align="left">Преподаватель</th>
		<th align="left">Обозн.</th>
		<th align="left">Часы</th>
		<th align="left">Действия</th>
	</tr>
	<?php foreach ($aSubjects as $aItem): ?>
		<tr entity_id="<?php echo($aItem['id']); ?>">
			<td><input type="text" class="js_contraction" size="80" name="subject_name" value="<?php echo($aItem['subject_name']); ?>"></td>
			<td><input type="text" class="js_contraction" size="3" name="subject_contraction" value="<?php echo($aItem['subject_contraction']); ?>"></td>
			<td>
				<select name="teacher">
					<?php foreach ($aTeachers as $aTeacher): ?>
						<option value="<?php echo($aTeacher['id']); ?>"<?php echo(($aTeacher['id'] == $aItem['teacher_id']) ? 'selected="selected"' : ''); ?>><?php echo($aTeacher['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" class="js_contraction" size="3" name="teacher_contraction" value="<?php echo($aItem['teacher_contraction']); ?>"></td>
			<td>
				<select name="hour_count">
					<option value="1">1</option>
					<option value="2" selected="selected">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
			</td>
			<td nowrap>
				<input type="button" name="copy" value="Copy">
				<input type="button" name="del" value="Del">
				<input type="button" name="check" value="V">
			</td>
		</tr>
	<?php endforeach; ?>
</table></p>

<p><table id="js_cycle_action">
	<tr>
		<th align="left">Мероприятие</th>
		<th align="left">Обозн.</th>
		<th align="left">Преподаватель</th>
		<th align="left">Обозн.</th>
		<th align="left">Часы</th>
		<th align="left">Действия</th>
	</tr>
	<?php foreach ($aActions as $aItem): ?>
		<tr entity_id="<?php echo($aItem['timetable_cycle_action_id']); ?>">
			<td><?php echo($aItem['action_name']); ?></td>
			<td name="action_contraction"><?php echo($aItem['action_contraction']); ?></td>
			<td>
				<select name="teacher">
					<option value="-2">Выберите преподавателя</option>
					<?php foreach ($aTeachers as $aTeacher): ?>
						<option value="<?php echo($aTeacher['id']); ?>"<?php echo(($aTeacher['id'] == $aItem['teacher_id']) ? 'selected="selected"' : ''); ?>><?php echo($aTeacher['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" class="js_contraction" size="3" name="teacher_contraction" value="<?php echo($aItem['teacher_contraction']); ?>"></td>
			<td>
				<select name="hour_count">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2" selected="selected">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
				</select>
			</td>
			<td>
				<input type="button" name="check" value="V">
			</td>
		</tr>
	<?php endforeach; ?>
</table></p>