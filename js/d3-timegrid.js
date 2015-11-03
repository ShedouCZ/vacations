// d3 code
// date conventions: [start, end) (end is not included in the interval!)


App.timegrid = App.timegrid || {};
App.timegrid.mousedown_data = {};

App.data = App.data || {};
App.data.users_by_fullname = {};
App.data.users_by_id = {};
App.data.ticks_by_fullname = {};

// construct lookup table
for (var key in App.data.users) {
	var fullname = App.data.users[key].User.fullname;
	App.data.users_by_fullname[fullname] = App.data.users[key];
	var id = App.data.users[key].User.id;
	App.data.users_by_id[id] = App.data.users[key];
}

// enrich vacations by futher info for easier lookups
App.enrich_vacation = function (vacation) {
	vacation.User = App.data.users_by_id[vacation.Vacation.user_id].User;
	vacation.VacationType = App.data.vacation_types[vacation.Vacation.vacation_type_id];
};
for (var key in App.data.vacations) {
	App.enrich_vacation(App.data.vacations[key]);
}

App.get_vacation_length = function (start, end) {
	// we interpret end as exclusive and ceil both using startOf('day')
	// for db vacations during clipping the label ... ok
	// for mouse events during creation of vacations the callee does +1 to account for the exclusive end date
	return moment(end).startOf('day').diff(moment(start).startOf('day'), 'days');
};
App.get_vacation_year_split = function (vacation) {
	var $start = moment(vacation.start);
	var $end   = moment(vacation.end);
	var res = {};
	if ($end.year() < $start.year()) return [];
	while ($end.year() > $start.year()) {
		var $year_end = $start.clone().endOf('year');
		$year_end.add(1, 'ms');       // move clock to next day
		res[$start.year()] = $year_end.diff($start, 'days');
		$start = $year_end;
	}
	res[$start.year()] = $end.diff($start, 'days');
	return res;
};
App.sum_year_splits = function (obj1, obj2) {
	for (var attrname in obj2) {
		obj1[attrname] = obj2[attrname] + (obj1[attrname] || 0);
	}
	return obj1;
};
App.data.year_splits = {};
App.compute_year_splits = function (vacations) {
	vacations = vacations || App.data.vacations;
	App.data.year_splits = {};
	for (var key in vacations) {
		var fullname = vacations[key].User.fullname;
		var vacation = vacations[key].Vacation;
		var year_split = App.get_vacation_year_split(vacation);
		if (!App.data.year_splits[fullname]) {
			App.data.year_splits[fullname] = year_split;
		} else {
			App.data.year_splits[fullname] = App.sum_year_splits(App.data.year_splits[fullname], year_split);
		}

	}
};

App.timegrid.render = function (defaults) {
	var g = defaults;
	g.padding = 20;
	g.padding_left = 200;
	g.brush = {};
	g.h_brush = 70;
	g.w_focus   = g.w - g.padding_left - g.padding;
	g.w_context = g.w_focus;
	g.h_focus   = g.h - g.h_brush - 4 * g.padding;

	//var parseDate = d3.time.format("%-d/%Y").parse;
	var sqlDate    = d3.time.format("%Y-%m-%d 00:00:00");
	var czDate     = d3.time.format("%-d.%-m. %Y");
	var parseDate  = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	var formatDate = d3.time.format("%-d.%-m.");
	var formatDay  = d3.time.format("%-d");


	// SCALES
	g.scale_x_f = d3.time.scale()
		.domain([parseDate(g.from), parseDate(g.till)])
		.range([0, g.w_focus]);
	g.scale_x_c = d3.time.scale()
		.domain([parseDate(g.from), parseDate(g.till)])
		.range([0, g.w_context]);

	g.scale_y_f = d3.scale.ordinal()
		.domain(App.data.users.map(function(d) {return d.User.fullname;}))
		.rangeRoundBands([0, g.h_focus])
		//.range([g.h - g.h_brush - 4 * g.padding, 0]);
		;
	g.scale_y_c = d3.scale.ordinal()
		.domain(App.data.users.map(function(d) {return d.User.fullname;}))
		.rangeRoundBands([0, g.h_brush])
		;
	g.scale_y_f.invert = function (y) {
		// custom ordinal invert function
		var domain = g.scale_y_f.domain(), range = g.scale_y_f.range();
		return domain[d3.bisect(range, y) - 1];
	};

	// AXES
	g.axis_x_f_bottom = d3.svg.axis()
		.scale(g.scale_x_f)
		.tickSize(-1 * g.h_focus)  // full height up to the top
		.ticks(d3.time.day, 1)
		.tickFormat('')
		.orient('bottom');
	g.axis_x_f_bottom_labels = d3.svg.axis() // two bottom axes - one for ticks, one for labels
		.scale(g.scale_x_f)
		.tickSize(0)
		.tickPadding(7)
		.ticks(d3.time.hour, 12)
		.tickFormat(function (d) {
			if (d.getHours() == 12) {
				return formatDay(d);
			} else {
				return null;
			}
		})
		.orient('bottom');
	g.axis_x_f_top = d3.svg.axis()
		.scale(g.scale_x_f)
		.ticks(d3.time.hour, 12)
		.tickFormat(function (d) {
			if (d.getHours() == 12) {
				return formatDay(d);
			} else {
				return null;
			}
		})
		.tickSize(0)
		.tickPadding(7)
		.orient('top');
	g.axis_x_c = d3.svg.axis()
		.scale(g.scale_x_c)
		.tickFormat(formatDate)
		.orient('top');

	g.axis_y = d3.svg.axis()
		.scale(g.scale_y_f)
		.orient('left')
		.tickFormat(function (d) {
			var year_split = App.data.year_splits[d];
			var shown_year = moment(g.scale_x_f.invert(g.w_focus / 3)).year();
			var sum = 0;
			if (year_split && year_split[shown_year]) { sum = year_split[shown_year]; }
			var user = App.data.users_by_fullname[d];
			var employee_type = App.data.employee_types[user.User.employee_type_id];
			var max = '0';
			if (employee_type && employee_type.days) max = employee_type.days;
			// store reference to the tick element
			App.data.ticks_by_fullname[d] = this;
			$(this).data('max', max);
			$(this).data('sum', sum);
			return d + ' - ' + sum + '/' + max;
		})
		;
	// SVG
	var svg = d3.select("#timegrid")
		.attr("width", g.w)
		.attr("height", g.h)
	;

	var defs = svg.append("defs");
	defs.append("clipPath")
		.attr("id", "clip")
		.append("rect")
		.attr("width", g.w_focus)
		.attr("height", g.h_focus)
		;

	var focus = svg.append("g")
		.attr("class", "focus")
		.attr("transform", "translate(" + g.padding_left + ", " + (0) + ")")
		;

	// rect to capture pointer events in the focus area
	var focus_area = focus.append('rect')
		.style("fill", "none")
		.attr("width",  g.w - g.padding_left - g.padding)
		.attr("height", g.h - g.h_brush - 4 * g.padding)
		.style("pointer-events", "all")
		;

	var context_svg = d3.select("#context")
		.attr("width", g.w)
		.attr("height", g.h_brush)
		;
	var context  =	context_svg.append("g")
		.attr("class", "context")
		.attr("transform", "translate(" + g.padding_left + ", " + g.padding + ")")
		;

	focus.append("g")
		.attr("class", "x axis bottom")
		.attr("transform", "translate(0, " + (g.h - g.h_brush - 4*g.padding) + ")")
		.call(g.axis_x_f_bottom)
		.call(g.axis_x_f_bottom_labels)
		;
	focus.append("g")
		.attr("class", "x axis bottom_labels")
		.attr("transform", "translate(0, " + (g.h - g.h_brush - 4*g.padding) + ")")
		.call(g.axis_x_f_bottom_labels)
		;

	focus.append("g")
		.attr("class", "y axis")
		.call(g.axis_y);

	context.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0,0)")
		.call(g.axis_x_c);

	context.append("g")
		.attr("class", "x axis top")
		.attr("transform", "translate(0, " + (g.h_brush - g.padding - 1) + ")")
		.call(g.axis_x_f_top);

	var bars = focus.append("g")
		.classed("bars", true)
		.attr("clip-path", "url(#clip)")
		;

	// FOCUS
	function rejoin (data, bars, context) {
		var bar = bars.selectAll(".bar")
			.data(data)
			;

		// update already existing data
		bar.select('text').text(function (d) { return d.Vacation.id + '. ' + d.VacationType.title; } )

		// new arrivals
		var enter = bar.enter();
		var group = enter.append("g")
				.attr('transform', function (d) {
					var left = g.scale_x_f(parseDate(d.Vacation.start));
					var top  = g.scale_y_f(d.User.fullname);
					return "translate("+left+","+top+")";
				})
				.attr("class", function (d) {
					return 'type-' + d.VacationType.id;
				})
				.classed('bar', true)
			;
		group.append('rect')
			.attr("height", g.h_bar)
			.attr('width', function (d) {
				var left  = g.scale_x_f(parseDate(d.Vacation.start));
				var right = g.scale_x_f(parseDate(d.Vacation.end));
				return right - left;
			})
			;
		group.append('text').text(function (d) { return d.Vacation.id + '. ' + d.VacationType.title; } )
			.attr('dy', Math.floor(g.h_bar / 2) + 5 + 'px')
			.attr('dx', '5px')
			.attr('clip-path', function(d) {
				var day_diff = App.get_vacation_length(d.Vacation.start, d.Vacation.end);
				var clip_id = 'r-days-' + day_diff;
				if (d3.select('#' + clip_id).empty()) {
					// clippath to clip text (grouped by days)
					var left  = g.scale_x_f(parseDate(d.Vacation.start));
					var right = g.scale_x_f(parseDate(d.Vacation.end));
					var width = right - left;
					defs.append('clipPath')
						.classed('r-days', true)
						.attr('id', clip_id)
						.append('rect')
						.datum(d) // so we may easily rescale
						.attr("height", g.h_bar)
						.attr('width', width)
						;
				}
				return 'url(#' + clip_id + ')'
			})
			;

		// removals
		bar.exit().remove();
	}

	// brush
	g.brush = d3.svg.brush()
		.x(g.scale_x_c)
		.extent([g.scale_x_c.invert(0), g.scale_x_c.invert(g.w_focus / 4)])
		.on("brush", brushed)
		;

	context.append("g")
		.attr("class", "x brush")
		.call(g.brush)
		.selectAll("rect") // two of then there: background + extent
		.attr("y", 1)
		.attr("height", g.h_brush - 2*g.padding - 7);

	rejoin(App.data.vacations, bars, context);

	function rescale() {
		context.select(".x.axis.top").call(g.axis_x_f_top);
		// two bottom axes - one for ticks, one for labels
		focus.select(".x.axis.bottom").call(g.axis_x_f_bottom);
		focus.select(".x.axis.bottom_labels").call(g.axis_x_f_bottom_labels);
		focus.select(".y.axis").call(g.axis_y);
		bars.selectAll(".bar")
			.attr('transform', function (d) {
				var left = g.scale_x_f(parseDate(d.Vacation.start));
				var top  = g.scale_y_f(d.User.fullname);
				return "translate("+left+","+top+")";
			})
			.select('rect')
				.attr('width', function (d) {
					var left  = g.scale_x_f(parseDate(d.Vacation.start));
					var right = g.scale_x_f(parseDate(d.Vacation.end));
					return right - left;
				})
			;

		defs.selectAll('.r-days rect')
				.attr('width', function (d) {
					var left  = g.scale_x_f(parseDate(d.Vacation.start));
					var right = g.scale_x_f(parseDate(d.Vacation.end));
					return right - left;
				})
			;
	}

	function brushed() {
		// adjust focused scale
		// http://stackoverflow.com/questions/22873551/d3-js-brush-controls-getting-extent-width-coordinates
		var extent = g.brush.extent();
		var day_diff = moment(extent[1]).diff(moment(extent[0]), 'days');
		var shown_year = moment(g.scale_x_f.invert(g.w_focus / 4)).year();

		if (g.last_shown_year != shown_year) {
			App.compute_year_splits();
			g.last_shown_year = shown_year;
		}

		if (day_diff >= 30 && day_diff <= 92) {
			g.last_brush_extent = extent;
			g.last_selection = d3.select(this);
			g.scale_x_f.domain(g.brush.empty() ? g.scale_x_c.domain() : g.brush.extent());
			// update bars+axis to draw with new scales
			rescale();
			// reset zoom scale
			// zoom.x(g.scale_x_f);
		} else {
			g.brush.extent(g.last_brush_extent);
			g.brush(g.last_selection);
		}
	}

	// redraw immediately to show selected (1/3) extent
	brushed();

	function zoomed() {
		console.log(d3.event.translate);
		// x is relative to current position
		var x = d3.event.translate[0];
		rescale();
		// force changing brush range
		g.brush.extent(g.scale_x_f.domain());
		svg.select(".brush").call(g.brush);
	}
	var zoom = d3.behavior.zoom()
		//.scaleExtent([1, 27])
		.scaleExtent([1, 1])
		.x(g.scale_x_f)
		.on("zoom", zoomed)
		;

	// no zoom no pan now
	// as click for adding new vacations
	if (0) d3.select('.focus').call(zoom)
		.on("wheel.zoom", null)	// keep wheel -> scroll
	;

	function mousedown () {
		if (d3.select(d3.event.target.parentNode).datum()) {
			// target is a bar - a click listener will fire
			return;
		}

		d3.event.preventDefault();
		svg.classed('active', true);

		if (App.timegrid.mousedown_g) return;

		var point = d3.mouse(this);
		App.timegrid.mousedown_data.start_js = g.scale_x_f.invert(point[0]);
		App.timegrid.mousedown_data.start = sqlDate(App.timegrid.mousedown_data.start_js); // floor to midnight done here
		App.timegrid.mousedown_data.x0 = g.scale_x_f(parseDate(App.timegrid.mousedown_data.start));
		App.timegrid.mousedown_data.user_fullname = g.scale_y_f.invert(point[1]);
		App.timegrid.mousedown_data.user = App.data.users_by_fullname[App.timegrid.mousedown_data.user_fullname];
		App.timegrid.mousedown_data.$label = $(App.data.ticks_by_fullname[App.timegrid.mousedown_data.user_fullname]);
		App.timegrid.mousedown_data.original_label = App.timegrid.mousedown_data.$label.text();

		App.timegrid.mousedown_g = focus.append("g")
			.attr('transform', function (d) {
				var left = App.timegrid.mousedown_data.x0;
				var top  = g.scale_y_f(App.timegrid.mousedown_data.user_fullname);
				return "translate("+left+","+top+")";
			})
			.classed('bar new', true)
		;

		App.timegrid.mousedown_data.rect = App.timegrid.mousedown_g.append('rect')
			.attr("height", g.h_bar)
			.attr('width', 2)
		;
		App.timegrid.mousedown_g.append('text')
			.attr('y', Math.floor(g.h_bar / 2) + 5)
			.attr('x', 4)
			.text(formatDate(App.timegrid.mousedown_data.start_js))
		;
	}

	function mousemove () {
		var end_x = 0;
		// hover updates
		if (App.timegrid.hover_group) {
			var mouse_x = d3.mouse(this)[0];
			var mouse_y = d3.mouse(this)[1];
			var end_js = g.scale_x_f.invert(mouse_x);
			// compute rounded date
			var end_rounded = sqlDate(addDays(end_js, 1));
			end_x = g.scale_x_f(parseDate(end_rounded));

			//App.timegrid.hover_line.attr("x1", mouse_x).attr("x2", mouse_x);
			App.timegrid.hover_date.text(formatDate(end_js));
  			App.timegrid.hover_date.attr('x', mouse_x + 5);
			App.timegrid.hover_date.attr('y', mouse_y - 20);
		}

		// vacation creation updates
		if (!App.timegrid.mousedown_g) return;
		App.timegrid.mousedown_data.rect
			//.attr('width', d3.mouse(this)[0] - App.timegrid.mousedown_data.x0 )
			.attr('width', end_x - App.timegrid.mousedown_data.x0 )
		;
		// update user tick in y.axis with new number of days!
		var sum = App.timegrid.mousedown_data.$label.data('sum');
		var max = App.timegrid.mousedown_data.$label.data('max');
		var d = App.timegrid.mousedown_data.user_fullname;
		// adjust sum
		// TODO account for year splits here as well
		// + 1 ... include the ending day
		sum += App.get_vacation_length(App.timegrid.mousedown_data.start_js, end_js) + 1;
		App.timegrid.mousedown_data.$label.text(d + ' - ' + sum + '/' + max);

	}

	function addDays(date, days) {
		var result = new Date(date);
		result.setDate(date.getDate() + days);
		return result;
	}

	function mouseup () {
		svg.classed('active', false);
		if (App.timegrid.mousedown_g) {
			// end point
			var point = d3.mouse(this);
			App.timegrid.mousedown_data.end_js = addDays(g.scale_x_f.invert(point[0]), 1); // plus one as we floor
			App.timegrid.mousedown_data.end = sqlDate(App.timegrid.mousedown_data.end_js); // floor to midnight done here

			var clearing = function () {
				// clearing
				App.timegrid.mousedown_g.remove();
				App.timegrid.mousedown_g = false;
				App.timegrid.mousedown_data = {};
				focus.select(".y.axis").call(g.axis_y);
			}

			var view_vars = {
				start: moment(App.timegrid.mousedown_data.start).format('DD.MM. YYYY'),
				end:   moment(App.timegrid.mousedown_data.end).subtract(1, 'day').format('DD.MM. YYYY'), // -1 day for humans as our end is exclusive moment
				vacation_types: App.data.vacation_types,
				fullname: App.timegrid.mousedown_data.user_fullname
			};

			bootbox.dialog({
				title: "Create New Vacation",
				message: App.render["/Vacations/add"](view_vars),
				onEscape: function  () {
					clearing();
				},
				buttons: {
					cancel: {
						label: "Cancel",
						className: "btn-default",
						callback: function () {
							clearing();
						}
					},
					success: {
						label: "Save",
						className: "btn-success",
						callback: function () {
							var fields = {
								title: '#VacationTitle',
								vacation_type_id: '#VacationVacationTypeId',
								start: '#VacationStart',
								end: '#VacationEnd'
							};
							Object.keys(fields).map(function(k,i) {
								fields[k] = $('#vacations-add-hbs '+fields[k]).val();
							});

							// end date: humans -> exclusive moment
							fields.end = moment(fields.end, 'DD.MM. YYYY').add(1,'day').format('DD.MM. YYYY');

							// new Vacation
							var fullname = App.timegrid.mousedown_data.user_fullname;
							var Vacation = {
								id: 'x',
								title: fields.title,
								start: moment(fields.start, 'DD.MM. YYYY').format('YYYY-MM-DD 00:00:00'),
								end:   moment(fields.end, 'DD.MM. YYYY').format('YYYY-MM-DD 00:00:00'),
								vacation_type_id: fields.vacation_type_id,
								user_id: App.data.users_by_fullname[fullname].User.id
							};
							var item = {
								Vacation: Vacation,
							};
							App.enrich_vacation(item);
							var item_index = App.data.vacations.push(item) - 1; // push returns new length
							App.compute_year_splits();
							rejoin(App.data.vacations, bars, context);
							focus.select(".y.axis").call(g.axis_y);

							// ajax submit
							var url = '/vacations/add';
							var data = {
								Vacation: {
									vacation_type_id: fields.vacation_type_id,
									title: fields.title,
									start: fields.start,
									end:   fields.end,
									user_id: App.timegrid.mousedown_data.user.User.id
								}
							};
							var xhr = $.post(url, {data:data})

							clearing();

							// replace fake id with server generated one
							xhr.done(function (result) {
								item.Vacation.id = result;
								// update bars
								rejoin(App.data.vacations, bars, context);
							});
							xhr.fail(function (result) {
								console.log(result);
								// remove item from App.data.vacations
								App.data.vacations.splice(item_index, 1);
								// update bars
								rejoin(App.data.vacations, bars, context);
							});
						}
					}
				}
			})
			.init(function () {
				// timepickers init
				$('#vacations-add-hbs input[data-provide=datepicker]').datetimepicker()
				.next().click(function() {
					// clicking an input-group-addon (next sibling)
					$(this).prev().focus();
				});
			})
			.on('shown.bs.modal', function(){
				// focus
				$('#vacations-add-hbs #VacationTitle').focus();
			});
		}
	}

	function mouseenter () {
		if (!App.timegrid.hover_group) {
			// adding hoverline
			App.timegrid.hover_group = focus.append("g")
				.classed("hover-line", true);
			if (0) App.timegrid.hover_line = App.timegrid.hover_group.append("line")
				.attr("x1", 10).attr("x2", 10)
				.attr("y1", 0).attr("y2", g.h_focus);
			App.timegrid.hover_date = App.timegrid.hover_group.append('text')
				.attr("class", "hover-date")
				.attr('y', 0);
			}
	}
	function mouseleave () {
		if (!App.timegrid.hover_line) return;
		App.timegrid.hover_group.remove();
		App.timegrid.hover_group = false;
	}
	function mouseclick () {
		var d;
		if (d = d3.select(d3.event.target.parentNode).datum()) {
			window.location = "/vacations/edit/"+d.Vacation.id
		}
	}

	focus
		.on('mousemove' , mousemove)
		.on('mouseenter', mouseenter)
		.on('mouseleave', mouseleave)
		.on('click'     , mouseclick)
	;
	if (App.user_id) {
		focus
			.on('mousedown' , mousedown)
			.on('mouseup'   , mouseup)
		;
	}

};

if ($('#Vacations').length) {
	var g = {};
	g.h_bar = 25;
	g.h = App.data.users.length * g.h_bar + 10;
	g.w = parseInt($('#Vacations').css('width'),10);

	g.from = moment().startOf('month').format('YYYY-MM-DD HH:mm:ss');
	g.till = moment().endOf('month').add(5,'months').endOf('month').format('YYYY-MM-DD HH:mm:ss');

	App.timegrid.render(g);
}
