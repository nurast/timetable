$(document).ready(function () {
	$(document).on('click', '#js_cycle_subject input[name="copy"]', function (event) {
		var iEntityId = $(this).parents('tr').attr('entity_id');
		var oEntity = $(this).parents('tr');
		var oCopy = $(this).parents('tr').clone();
		$.ajax({
			url: 'copyTimetableCycleSubject',
			dataType: 'json',
			data: {entity_id: iEntityId},
			success: function (data) {
				if (data['status'] == 'OK') {
					oCopy.attr('entity_id', data['id']);
					oEntity.after(oCopy);
				}
			}
		});
	});

	$(document).on('click', '#js_cycle_subject input[name="del"]', function (event) {
		var iEntityId = $(this).parents('tr').attr('entity_id');
		var oEntity = $(this).parents('tr');
		$.ajax({
			url: 'deleteTimetableCycleSubject',
			dataType: 'json',
			data: {entity_id: iEntityId},
			success: function (data) {
				if (data['status'] == 'OK') {
					oEntity.remove();
				}
			}
		});
	});

	$(document).on('change', '#js_cycle_subject select[name="teacher"]', function (event) {
		var oTr = $(this).parents('tr');
		var iEntityId = oTr.attr('entity_id');
		var iTeacherId = $(this).val();
		$.ajax({
			url: 'updateTimetableCycleSubject',
			dataType: 'json',
			data: {
				entity_id: iEntityId,
				field_name: 'teacher_id',
				field_value: iTeacherId
			},
			success: function (data) {
				if (data['status'] == 'OK') {
					oTr.find('input[name="teacher_contraction"]').prop('value', data['contraction']);
				}
			}
		});
	});

	$(document).on('change', '#js_cycle_subject .js_contraction', function (event) {
		var sFieldName = $(this).attr('name');
		var iEntityId = $(this).parents('tr').attr('entity_id');
		var sFieldValue = $(this).prop('value');
		$.ajax({
			url: 'updateTimetableCycleSubject',
			data: {
				entity_id: iEntityId,
				field_name: sFieldName,
				field_value: sFieldValue
			}
		});
	});

	$(document).on('change', '#js_cycle_action select[name="teacher"]', function (event) {
		var oTr = $(this).parents('tr');
		var iEntityId = oTr.attr('entity_id');
		var iTeacherId = $(this).val();
		$.ajax({
			url: 'updateTimetableCycleAction',
			dataType: 'json',
			data: {
				entity_id: iEntityId,
				field_name: 'teacher_id',
				field_value: iTeacherId
			},
			success: function (data) {
				if (data['status'] == 'OK') {
					oTr.find('input[name="teacher_contraction"]').prop('value', data['contraction']);
				}
			}
		});
	});

	$(document).on('change', '#js_cycle_action .js_contraction', function (event) {
		var iEntityId = $(this).parents('tr').attr('entity_id');
		var sFieldName = 'teacher_contraction';
		var sTeacherContraction = $(this).parents('tr').find('input[name="teacher_contraction"]').prop('value');
		$.ajax({
			url: 'updateTimetableCycleAction',
			data: {
				entity_id: iEntityId,
				field_name: sFieldName,
				field_value: sTeacherContraction
			}
		});
	});

	$(document).on('click', '#js_cycle_subject input[name="check"]', function (event) {
		$('table').find('tr.js_checked').removeClass('js_checked').removeAttr('bgcolor');
		$(this).parents('tr').addClass('js_checked');
		$(this).parents('tr').attr('bgcolor', 'silver');
	});

	$(document).on('click', '#js_cycle_action input[name="check"]', function (event) {
		$('table').find('tr.js_checked').removeClass('js_checked').removeAttr('bgcolor');
		$(this).parents('tr').addClass('js_checked');
		$(this).parents('tr').attr('bgcolor', 'silver');
	});
});