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

$(document).ready(function(){
    $('.btn-search').on('click', function(e) {
        $('.searchform').toggleClass("w-show");
        e.preventDefault();
    });
    $('.btn-search').click(function(){
        $('.btn-search i').toggleClass("fa-x");
    });
    // height header
    $('.height-header').css("height",$("header").height()+"px");

        $("#loader-wrapper").fadeOut(2000);


    setTimeout(function(){
        $(".loade").fadeOut("slow");
        $("body .placeholder").removeClass("placeholder");
        $("body .placeholder-glow").removeClass("placeholder-glow");
   }, 50);

});
    $(function () {
      'use strict';
      $(window).scroll(function () {
          var nav = $('header')
          var nav2 = $('header')
          if ($(window).scrollTop() >= ( nav.height() + nav2.height() )-123 ) {
              nav.addClass('header-top')
          }else{
              nav.removeClass('header-top')
          }
          if (document.getElementById('wpadminbar')) {
            $(".fixed-top").css({"top": "10px "});
          }
      })
  });

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }


    $('#slider').owlCarousel({
        loop: false,
        rtl:true,
        //animateOut: 'fadeOut',
        margin: 0,
        autoHeight:true,
        nav: true,
        navText:['<i class="fa-solid fa-chevron-left fa-2x text-white shadow rounded-0 p-2"></i>','<i class="fa-solid fa-chevron-right fa-2x text-white shadow rounded-0 p-2"></i>'],
        dots: false,
        //autoplay:true,
        //autoplayTimeout:5000,
        //autoplayHoverPause:true,
        items: 1,
    });


$('#service-name').owlCarousel({
    loop: true,
    rtl:true,
    margin: 15,
    autoHeight:true,
    nav: true,
    navText:['<i class="fa-solid fa-chevron-left fs-25p text-white shadow rounded-0 p-2"></i>','<i class="fa-solid fa-chevron-right fs-25p text-white shadow rounded-0 p-2"></i>'],
    dots: false,
    autoplay:true,
    autoplayTimeout:5000,
    autoplayHoverPause:true,
    responsive:{
                0:{
                    items:2
                },
                380:{
                    items:2,
                    // nav: false,
                    // dots: true,
                },
                768:{
                    items:3,
                    // nav: false,
                    // dots: true,
                },
                991:{
                    items:3
                },
                1272:{
                    items:4
                }
            }
    });
 // end osama


(function() {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    }

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all)
        if (selectEl) {
            if (all) {
                selectEl.forEach(e => e.addEventListener(type, listener))
            } else {
                selectEl.addEventListener(type, listener)
            }
        }
    }

    /**
     * Back to top button
     */
    let backtotop = select('.back-to-top')
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add('active')
            } else {
                backtotop.classList.remove('active')
            }
        }
        window.addEventListener('load', toggleBacktotop)
        onscroll(document, toggleBacktotop)
    }

    /**
     * Animation on scroll
     */
    window.addEventListener('load', () => {
    $(document).ready(function () {
        AOS.init({
            disable: 'mobile',
            duration: 1000,
            // easing: 'ease-in-out',
            once: true,
            // mirror: false,
        })
    })
      });
})()
