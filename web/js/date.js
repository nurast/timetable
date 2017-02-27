$(document).ready(function () {
	$('#js_cycle_select').bind('change', function () {
		var iCycleId = $(this).val();
		$.ajax({
			url: 'cycle/getDateList',
			dataType: 'html',
			data: {cycle_id: iCycleId},
			success: function (data) {
				$('#js_date_select').html(data);

			}
		});
	});

	$('form').bind('submit', function () {
		if ($('#js_date_select select').length > 0) {
			var sVal = $('#js_date_select select').val();
			$('#js_date_select').find('select').find('option').each(function () {
				if ($(this).attr('value') == sVal) {
					$('input[name="start"]').attr('value', $(this).attr('start'));
					$('input[name="finish"]').attr('value', $(this).attr('finish'));
				}
			});
		}
	});
});