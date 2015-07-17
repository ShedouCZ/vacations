    // MODULE: eonasdan timepicker
	$('input[data-provide=datepicker]').datetimepicker()
	.next().click(function() {
		// clicking an input-group-addon (next sibling)
		$(this).prev().focus();
	});
	$('input#BookingStart').on('dp.hide', function (e) {
		// sensible default for BookingEnd
		var $end = $('input#BookingEnd');
		$end.data('DateTimePicker').setMinDate(e.date);
		if (!$end.val()) {
			$end.data('DateTimePicker').setDate(e.date.add(1, 'h'));
		}
	});
	$('input#BookingEnd').on('dp.hide', function (e) {
		// sensible default for BookingStart
		var $start = $('input#BookingStart');
		$start.data('DateTimePicker').setMaxDate(e.date);
		if (!$start.val()) {
			$start.data('DateTimePicker').setDate(e.date.subtract(1, 'h'));
		}
	});

    // MODULE: colorpicker
	$('input[data-provide=colorpicker]').tinycolorpicker({
		remover: 'remove'
	});
