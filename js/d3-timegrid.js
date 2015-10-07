// d3 code

App.timegrid = App.timegrid || {};
App.timegrid.mousedown_data = {};

App.data = App.data || {};
App.data.users_by_fullname = {};
// construct lookup table
for (var key in App.data.users) {
	var fullname = App.data.users[key].User.fullname;
	App.data.users_by_fullname[fullname] = App.data.users[key];
}

App.timegrid.render = function (defaults) {
	var g = defaults;
	g.padding = 20;
	g.padding_left = 160;
	g.brush = {};
	g.h_brush = 70;
	g.w_focus   = g.w - g.padding_left - g.padding;
	g.w_context = g.w_focus;
	g.h_focus   = g.h - g.h_brush - 4 * g.padding;

	g.from = '2015-08-01 00:00:00';
	g.till = '2015-10-31 00:00:00';

	//var parseDate = d3.time.format("%-d/%Y").parse;
	var sqlDate    = d3.time.format("%Y-%m-%d 00:00:00");
	var czDate     = d3.time.format("%-d.%-m. %Y");
	var parseDate  = d3.time.format("%Y-%m-%d %H:%M:%S").parse;
	var formatDate = d3.time.format("%-d.%-m.");


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
		.tickFormat(formatDate)
		.orient('bottom');
	g.axis_x_f_top = d3.svg.axis()
		.scale(g.scale_x_f)
		.ticks(d3.time.day, 1)
		.tickFormat(formatDate)
		.orient('top');
	g.axis_x_c = d3.svg.axis()
		.scale(g.scale_x_c)
		.tickFormat(formatDate)
		.orient('top');
	g.axis_y = d3.svg.axis()
		.scale(g.scale_y_f)
		.orient('left');

	// SVG
	var svg = d3.select("#timegrid")
		.attr("width", g.w)
		.attr("height", g.h)
	;

	svg.append("defs").append("clipPath")
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
	var bars = focus.append("g")
		.classed("bars", true)
		.attr("clip-path", "url(#clip)")
		;

	// FOCUS
	function rejoin (data, bars, context) {
		var bar = bars.selectAll(".bar")
			.data(data)
			.enter().append("g")
				.attr('transform', function (d) {
					var left = g.scale_x_f(parseDate(d.Vacation.start));
					var top  = g.scale_y_f(d.User.fullname);
					return "translate("+left+","+top+")";
				})
				.classed('bar', true)
			;
		bar.append('rect')
			.attr("height", g.h_bar)
			.attr('width', function (d) {
				var left  = g.scale_x_f(parseDate(d.Vacation.start));
				var right = g.scale_x_f(parseDate(d.Vacation.end));
				return right - left;
			})
			;
		bar.append('text').text(function (d) { return d.VacationType.title; } )
			.attr('dy', Math.floor(g.h_bar / 2) + 5 + 'px')
			.attr('dx', '5px')
			;
	}

	focus.append("g")
		.attr("class", "x axis bottom")
		.attr("transform", "translate(0, " + (g.h - g.h_brush - 4*g.padding) + ")")
		.call(g.axis_x_f_bottom);

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

	// brush
	var brush = d3.svg.brush()
		.x(g.scale_x_c)
		.extent([g.scale_x_c.invert(0), g.scale_x_c.invert(g.w_focus / 3)])
		.on("brush", brushed)
		;

	context.append("g")
		.attr("class", "x brush")
		.call(brush)
		.selectAll("rect") // two of then there: background + extent
		.attr("y", 1)
		.attr("height", g.h_brush - 2*g.padding - 7);

	rejoin(App.data.vacations, bars, context);

	// draw axes

	// draw grid
	// g.ticks = 6;
	//
	// g.grid_axis_y = g.axis_y.ticks(g.ticks)
	// 	.tickSize(g.w, 0)
	// 	.tickFormat('')
	// 	.orient('right');
	//
	// g.grid_axis_x = g.axis_x_f.ticks(g.ticks)
	// 	.tickSize(-g.h, 0)
	// 	.tickFormat('')
	// 	.orient('top');

	// svg.append("g")
	// 	.classed('y', true)
	// 	.classed('grid', true)
	// 	.call(g.grid_axis_y);

	function rescale() {
		context.select(".x.axis.top").call(g.axis_x_f_top);
		focus.select(".x.axis.bottom").call(g.axis_x_f_bottom);
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
	}

	function brushed() {
		// adjust focused scale
		g.scale_x_f.domain(brush.empty() ? g.scale_x_c.domain() : brush.extent());
		// update bars+axis to draw with new scales
		rescale();
		// reset zoom scale
		// zoom.x(g.scale_x_f);
	}

	// redraw immediately to show selected (1/4) extent
	brushed();

	function zoomed() {
		console.log(d3.event.translate);
		// x is relative to current position
		var x = d3.event.translate[0];
		rescale();
		// force changing brush range
		brush.extent(g.scale_x_f.domain());
		svg.select(".brush").call(brush);
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
		d3.event.preventDefault();
		svg.classed('active', true);

		if (App.timegrid.mousedown_g) return;

		var point = d3.mouse(this);
		App.timegrid.mousedown_data.start_js = g.scale_x_f.invert(point[0]);
		App.timegrid.mousedown_data.start = sqlDate(App.timegrid.mousedown_data.start_js); // floor to midnight done here
		App.timegrid.mousedown_data.x0 = g.scale_x_f(parseDate(App.timegrid.mousedown_data.start));
		App.timegrid.mousedown_data.user_fullname = g.scale_y_f.invert(point[1]);
		App.timegrid.mousedown_data.user = App.data.users_by_fullname[App.timegrid.mousedown_data.user_fullname];

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

			App.timegrid.hover_line.attr("x1", mouse_x).attr("x2", mouse_x);
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
			App.timegrid.mousedown_data.end_js = addDays(g.scale_x_f.invert(point[0]), 1); // one plus os we floor
			App.timegrid.mousedown_data.end = sqlDate(App.timegrid.mousedown_data.end_js); // floor to midnight done here

			// new Vacation
			var Vacation = {
				id: 'PLACEHOLDER',
				start: App.timegrid.mousedown_data.start,
				end: App.timegrid.mousedown_data.end,
				vacation_type_id: 2,
				user_id: 114
			};
			var item = {
				Vacation: Vacation,
				User: {
					fullname: App.timegrid.mousedown_data.user_fullname
				},
				VacationType: {
					title: 'Služební cesta'
				}
			};
			App.data.vacations.push(item);
			rejoin(App.data.vacations, bars, context);

			// TODO ajax submit + PLACEHOLDERs update
			var url = '/admin/vacations/add';
			var data = {
				Vacation: {
					vacation_type_id: 2,
					title: 'none',
					start: czDate(App.timegrid.mousedown_data.start_js),
					end: czDate(App.timegrid.mousedown_data.end_js),
					user_id: App.timegrid.mousedown_data.user.User.id
				}
			};
			$.post(url, {data:data});

			App.timegrid.mousedown_g.remove();
			App.timegrid.mousedown_g = false;
			App.timegrid.mousedown_data = {};
		}
	}

	function mouseenter () {
		if (!App.timegrid.hover_group) {
			// adding hoverline
			App.timegrid.hover_group = focus.append("g")
				.classed("hover-line", true);
			App.timegrid.hover_line = App.timegrid.hover_group.append("line")
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

	focus
		.on('mousedown', mousedown)
		.on('mousemove', mousemove)
		.on('mouseup',   mouseup)
		.on('mouseenter', mouseenter)
		.on('mouseleave',  mouseleave)
	;

};

if ($('#Vacations').length) {
	var g = {};
	g.h_bar = 25;
	g.h = App.data.users.length * g.h_bar + 10;
	g.w = parseInt($('#Vacations').css('width'),10);
	App.timegrid.render(g);
}
