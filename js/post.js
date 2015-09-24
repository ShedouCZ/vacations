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

// MODULE sortable - employee types
var onAdd = function (/**Event*/evt) {
	var user_id = $(evt.item).data('item-id');
	var type_id = $(evt.item).closest('.employee_type_box').data('type-id');
	var data = {
		'id': user_id,
		'employee_type_id': type_id
	};
	var url = window.location.href;
	$.post(url, {data:data});
};
$('.employee_type_box').each(function(i,e) { 
	Sortable.create(e, {
		animation: 150,
		draggable: 'li',
		group: {
			name: 'type_id',
			pull: true,
			put: true
		},
		onAdd: onAdd
	});
});
$('.employee_type_box').on('click', 'li', function () {
	var $li = $(this);
	var user_id = $li.data('item-id');
	var $from = $li.closest('.employee_type_box');
	var type_id = $from.data('type-id');
	type_id = type_id + 1;
	type_id = type_id % $('.employee_type_box').length;
	$to = $('#employee_type_' + type_id);
	$li.hide(100, function () {
		$to.prepend($li);
		$li.show(100);
	});
	var data = {
		'id': user_id,
		'employee_type_id': type_id === 0 ? null : type_id
	};
	var url = window.location.href;
	$.post(url, {data:data});
});

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
}
var onscroll = function () {
	var windowTop = $(window).scrollTop(); // returns number
	if (stickyTop -40 < windowTop) {
		d3.select('.sticky').classed('stuck', true);
	} else {
		d3.select('.sticky').classed('stuck', false);
	}
};
var debounced_onscroll = debounce(onscroll, 100);

// STICKY elements - fixed position once their touch top menu
var $stickies = $('.sticky');
if ($stickies.length) {
	var stickyTop = $('.sticky').offset().top;
	$(window).scroll(debounced_onscroll);
}
