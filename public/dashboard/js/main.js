    $(document).ready(function(){
        $("#loader").fadeOut(1000);
    });

        $(".our-btn").click(function(){
		$(".our-btn").toggleClass("close");
		    $(".overlaymnu .our-btn").fadeIn();
            $("body").addClass("overflow-hidden");
            $(".navbar-collapse").css("right", "0");
	});
    $(".overlaymnu .our-btn").click(function(){
            $("body").removeClass("overflow-hidden");
            $(".navbar-collapse").css("right", "-100%");
            $(".overlaymnu .our-btn").toggle();
        });


    $(function () {
        'use strict';
        $(window).scroll(function () {
            var nav = $('header')
            var nav2 = $('header')
            if ($(window).scrollTop() >= (nav.height() + nav2.height()) - 300) {
                nav.addClass('header-top')
            } else {
                nav.removeClass('header-top')
            }
        })
    })
$('.datepicker').datepicker();
