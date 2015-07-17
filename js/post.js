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
	
	// MODULE sortable
	$('.list-group').each(function (i,e) {
	    var id = e.id;
	    var $e = $(e);
	    Sortable.create(document.getElementById(id), {
	        handle: '.glyphicon-move',
	        animation: 150,
	        // dragging ended
	        onEnd: function (/**Event*/ e) {
	            var data = $e.find('[data-item-id]').map(function (i,v) {
	                return {
	                    'id': $(v).data('item-id'),
	                    'ord': i
	                };
	            }).toArray();
	            var url = $e.data('reorder-url') || window.location.href;
	            $.post(url, {data:data});
	        }
	    });
	});
