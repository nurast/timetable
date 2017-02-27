<input type="hidden" name="save_plan_subjects" value="1">
<p style="color: red">Внимание! Расписание для данного цикла ранее не составлялось.
	Список предметов и преподавателей построен на основе плана проведения цикла.
	Чтобы продолжить работу, нажмите кнопку Сохранить.</p>
<p><table>
	<tr>
		<th>Предмет</th>
		<th>Преподаватель</th>
	</tr>
	<?php foreach ($aSubjects as $aItem): ?>
		<tr>
			<td><?php echo($aItem['subject_name']); ?></td>
			<td><?php echo($aItem['teacher_name']); ?></td>
			<input type="hidden" name="teacher_id[]" value="<?php echo($aItem['teacher_id']); ?>">
			<input type="hidden" name="subject_name[]" value="<?php echo($aItem['subject_name']); ?>">
			<input type="hidden" name="teacher_name[]" value="<?php echo($aItem['teacher_name']); ?>">
		</tr>
	<?php endforeach; ?>
</table></p>