$(function () {
    $(window).preloader({
        delay: 500
    });
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
	var clicks = 0;
	$("#cosfajengo").click(function(){
		clicks++;
		if(clicks == 20){
			$("#cosfajengo").attr('class', 'btn btn-danger btn-md');
		}
		if(clicks == 40){
			$("#cosfajengo").attr('class', 'btn btn-primary btn-md');
		}
		if(clicks == 60){
			$("#cosfajengo").attr('class', 'btn btn-info btn-md');
		}
		if(clicks == 80){
			$("#cosfajengo").attr('class', 'btn btn-md');
		}
		if(clicks == 100){
			$("#cosfajengo").attr('class', 'btn btn-success btn-md');
			clicks = 0;
		}
	});
});
