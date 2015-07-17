$( document ).ready(function() {
	scrollToTop();
	$(".scrollToTop").click(function() {
		$("html, body").animate({
			scrollTop: 0
		}, 500);
	});
});

$(window).bind('resizeEnd', function() {
	scrollToTop();
});

var scrollToTop = function() {
	var iw = $('body').innerWidth();
	var ih = $('body').innerHeight();
	if(iw > 1130) {
	//if(iw > 1130 && ih > 800) {
		var scroll = $('.scrollToTop');
		var scrollOfsetTop = Math.ceil($(".scrollToTopHelper").offset().top);
		var scrollIsFixed = false;
		var scrollBottom = $('body').height() - scrollOfsetTop + 7;
		scroll.css("bottom",scrollBottom);
		scroll.css("left",Math.ceil($(".scrollToTopHelper").offset().left)+15);
		$(window).scroll(function () {
			scrollOfsetTop = Math.ceil($(".scrollToTopHelper").offset().top);
			if ( !scrollIsFixed && $(this).scrollTop() > 142) {
				scroll.addClass("fix");
				scroll.css("bottom",15);
				scrollIsFixed = true;
			}
			if( scrollIsFixed && ($(this).scrollTop() >  (scrollOfsetTop - $(window).height() + 40) || $(this).scrollTop() < 142 ) ) {
				scrollBottom = $('body').height() - scrollOfsetTop + 7;
				scroll.css("bottom",scrollBottom);
				scroll.removeClass("fix");
				scrollIsFixed = false;
			}
		});
	} else {
		$('.scrollToTop').removeAttr('style');
	}
};
