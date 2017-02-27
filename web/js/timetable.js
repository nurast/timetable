$(document).ready(function () {
	$(document).on('click', '.js_active', function (event) {
		if (!$(this).hasClass('js_occupied')) { //если клетка свободна
			if ($('tr.js_checked').length > 0) { //если есть выделенный предмет
				var oTd = $(this);
				var iEntityId = $('tr.js_checked').attr('entity_id');
				var iTimetableId = $('input[name="timetable_id"]').attr('value');
				var iHourCount = $('tr.js_checked').find('select[name="hour_count"]').val();
				var sDate = $(this).attr('date');
				var iClass = $(this).parents('tr').attr('class_number');
				var iBrigade = $(this).parents('tr').attr('brigade');
				var iSession = $(this).parents('tr').attr('session');

				var iIsLecture = 1;
				if ($(this).parents('tr').hasClass('js_practice')) {
					iIsLecture = 0;
				}

				var bIsSubject = 1;
				if ($('tr.js_checked').parents('table').attr('id') == 'js_cycle_action') {
					bIsSubject = 0;
				}

				var sUrl;
				var sSubjectContraction;
				if (bIsSubject) {
					sUrl = 'createTimetableItem';
					sSubjectContraction = $('tr.js_checked').find('input[name="subject_contraction"]').prop('value');
				} else {
					sUrl = 'createTimetableActionItem';
					sSubjectContraction = $('tr.js_checked').find('td[name="action_contraction"]').html();
				}

				var sHtml = '<div style="font-family: monospace">' + sSubjectContraction + ' <input type="button" class="js_clear" value="X" style="color: red; font-size: 0.5em"></div>' +
						'<div style="font-family: monospace"><i>' + $('tr.js_checked').find('input[name="teacher_contraction"]').prop('value') + '</i> <input type="button" class="js_telecomm_mode" value="TELE" style="font-size: 0.5em"></div>' +
						'<select name="hour_count">' +
						'<option value="0"' + ((iHourCount == 0) ? ' selected="selected"' : '') + '>0</option>' +
						'<option value="1"' + ((iHourCount == 1) ? ' selected="selected"' : '') + '>1</option>' +
						'<option value="2"' + ((iHourCount == 2) ? ' selected="selected"' : '') + '>2</option>' +
						'<option value="3"' + ((iHourCount == 3) ? ' selected="selected"' : '') + '>3</option>' +
						'<option value="4"' + ((iHourCount == 4) ? ' selected="selected"' : '') + '>4</option>' +
						'<option value="5"' + ((iHourCount == 5) ? ' selected="selected"' : '') + '>5</option>' +
						'<option value="6"' + ((iHourCount == 6) ? ' selected="selected"' : '') + '>6</option>' +
						'<option value="7"' + ((iHourCount == 7) ? ' selected="selected"' : '') + '>7</option>' +
						'<option value="8"' + ((iHourCount == 8) ? ' selected="selected"' : '') + '>8</option>' +
						'<option value="9"' + ((iHourCount == 9) ? ' selected="selected"' : '') + '>9</option>' +
						'<option value="10"' + ((iHourCount == 10) ? ' selected="selected"' : '') + '>10</option>' +
						'</select>' +
						'<div><span class="ui-icon ui-icon-clock js_clock"></span></div>';

				$.ajax({
					url: sUrl,
					dataType: 'json',
					data: {
						timetable_id: iTimetableId,
						entity_id: iEntityId,
						hour_count: iHourCount,
						date: sDate,
						is_lecture: iIsLecture,
						class: iClass,
						brigade: iBrigade,
						session: iSession
					},
					success: function (data) {
						if (data['status'] == 'OK') {
							oTd.addClass('js_occupied');
							oTd.attr('item_id', data['id']);
							oTd.html(sHtml);
							if (bIsSubject) {
								oTd.addClass('js_subject');
								updateHours(iHourCount, 'add');
							}
						}
					}
				});
			}
		}
	});

	$(document).on('click', '.js_clear', function (event) {
		event.stopPropagation();
		var oTd = $(this).parents('td');
		var iItemId = oTd.attr('item_id');
		var iHourCount = oTd.find("select[name='hour_count']").val();

		var bIsSubject = 1;
		if (!oTd.hasClass('js_subject')) {
			bIsSubject = 0;
		}

		var sUrl;
		if (bIsSubject) {
			sUrl = 'deleteTimetableItem';
		} else {
			sUrl = 'deleteTimetableActionItem';
		}

		$.ajax({
			url: sUrl,
			dataType: 'json',
			data: {item_id: iItemId},
			success: function (data) {
				if (data['status'] == 'OK') {
					oTd.removeClass('js_occupied');
					oTd.removeAttr('item_id');
					oTd.html('&nbsp;');
					if (bIsSubject) {
						oTd.removeClass('js_subject');
						updateHours(iHourCount, 'del');
					}
				}
			}
		});
	});

	$(document).on('change', '#js_timetable select[name="hour_count"]', function (event) {
		var sItemType = 'TimetableActionItem';
		if ($(this).parents('td').hasClass('js_subject')) {
			sItemType = 'TimetableItem';
		}
		var iItemId = $(this).parents('td').attr('item_id');
		var iHourCount = $(this).val();
		$.ajax({
			url: 'changeHourCount',
			dataType: 'json',
			data: {
				item_type: sItemType,
				item_id: iItemId,
				hour_count: iHourCount
			},
			success: function (data) {
				if (data['status'] == 'OK' && data['hour_count'] != undefined && sItemType == 'TimetableItem') {
					var iFactHourCount = parseInt($('#fact_hour_count').html());
					iFactHourCount = iFactHourCount - parseInt(data['hour_count']) + parseInt(iHourCount);
					$('#fact_hour_count').html(iFactHourCount);
				}
			}
		});
	});

	$(document).on('click', '.js_telecomm_mode', function (event) {
		event.stopPropagation();
		var oTd = $(this).parents('td');
		oTd.toggleClass('js_telecomm');
		var iTelecommMode = oTd.hasClass('js_telecomm');
		if (iTelecommMode) {
			oTd.attr('bgcolor', 'silver');
		} else {
			oTd.removeAttr('bgcolor');
		}
		iTelecommMode = (iTelecommMode) ? 1 : 0;
		var sItemType = 'TimetableActionItem';
		if (oTd.hasClass('js_subject')) {
			sItemType = 'TimetableItem';
		}
		var iItemId = oTd.attr('item_id');

		$.ajax({
			url: 'setTelecommMode',
			data: {
				item_type: sItemType,
				item_id: iItemId,
				telecomm_mode: iTelecommMode
			}
		});
	});

	$(document).on('change', '.js_time_on', function (event) {
		var oTd = $(this).parents('td');
		var iItemId = oTd.attr('item_id');
		var sTimeOn = $(this).val();
		var sItemType = 'TimetableActionItem';
		if (oTd.hasClass('js_subject')) {
			sItemType = 'TimetableItem';
		}
		$.ajax({
			url: 'changeTimeOn',
			data: {
				item_type: sItemType,
				item_id: iItemId,
				time_on: sTimeOn
			}
		});
	});

	$(document).on('click', '.js_clock', function (event) {
		$(this).parent().html('<input type="time" class="js_time_on" value="09:00">');
	});

	function updateHours(iHourCount, sAction) {
		var iFactHourCount = parseInt($('#fact_hour_count').html());
		if (sAction == 'add') {
			iFactHourCount += parseInt(iHourCount);
		} else {
			iFactHourCount -= parseInt(iHourCount);
		}
		$('#fact_hour_count').html(iFactHourCount);
	}
})