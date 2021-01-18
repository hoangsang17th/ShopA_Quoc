

(function ($) {
"use strict";


    // Loading Box (Preloader)
    function handlePreloader() {
        if ($('.preloader').length) {
            $('.preloader').delay(200).fadeOut(500);
        }
    }


    // Header Style and Scroll to Top
    function headerStyle() {
        if ($('.main-header').length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $('.main-header');
            var scrollLink = $('.scroll-top');
            if (windowpos >= 250) {
                siteHeader.addClass('fixed-header');
                scrollLink.fadeIn(300);
            } else {
                siteHeader.removeClass('fixed-header');
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();

    // dropdown menu

    var mobileWidth = 767;
    var navcollapse = $('.navigation li.dropdown');

    $(window).on('resize', function () {
        navcollapse.children('ul').hide();
    });

    navcollapse.hover(function () {
        if ($(window).innerWidth() >= mobileWidth) {
            $(this).children('ul').stop(true, false, true).slideToggle(300);
            $(this).children('.megamenu').stop(true, false, true).slideToggle(300);
        }
    });


    //Submenu Dropdown Toggle
    if ($('.navigation li.dropdown ul').length) {
        $('.navigation li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-right"></span></div>');

        //Dropdown Button
        $('.navigation li.dropdown .dropdown-btn').on('click', function () {
            $(this).prev('ul').slideToggle(500);
            $(this).prev('.megamenu').slideToggle(800);
        });

        //Disable dropdown parent link
        $('.navigation li.dropdown > a').on('click', function (e) {
            e.preventDefault();
        });
    }

    //Submenu Dropdown Toggle
    if ($('.main-header .main-menu').length) {
        $('.main-header .main-menu .navbar-toggle').click(function () {
            $(this).prev().prev().next().next().children('li.dropdown').hide();
        });

    }
    // End Main menu

    new WOW().init();

    // four Item Carousel (team)
    if ($('.team-slider').length) {
        $('.team-slider').owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dats: true,
            autoHeight: true,
            smartSpeed: 500,
            autoplay: false,
            navText: ['<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                700: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
    }
    

    // single team member load more/ajax (team)
    if ($('.single-team-wrap').length) {

        $('.single-team-wrap').simpleLoadMore({
          item: '.single-team-member',
          count: 8,
          itemsToLoad: 4,
          btnHTML:'<div class="col-lg-12 text-center mt-20"><a href="#" class="btn-bg">LOAD MORE</a></div>'
        });

    }

    // shope grid page load more/ajax
    if ($('.single-product-item-wrap').length) {

        $('.single-product-item-wrap').simpleLoadMore({
          item: '.single-product-item',
          count: 8,
          itemsToLoad: 4,
          btnHTML:'<div class="col-lg-12 text-center"><a href="#" class="btn-bg">LOAD MORE</a></div>'
        });

    }

    // shope grid page load more/ajax
    if ($('.blog-grid-wrapper').length) {

        $('.blog-grid-wrapper').simpleLoadMore({
          item: '.row',
          count: 4,
          itemsToLoad: 2,
          btnHTML:'<div class="load-more-wrap text-center pt-45 pb-30"><a href="#" class="btn-bg">LOAD MORE</a></div>'
        });

    }
    
    // shope grid page load more/ajax
    if ($('.case-study-section').length) {

        $('.case-study-section').simpleLoadMore({
          item: '.single-case-study',
          count: 6,
          itemsToLoad: 3,
          btnHTML:'<div class="col-lg-12 text-center pt-25 pb-30"><a href="#" class="btn-bg">LOAD MORE</a></div>'
        });

    }
    


    /*========== Start Counter To Js funfact   ==========*/

    if ($('.funfact').length) {
        $(window).on('scroll.funfact', function () {
            var stat = $('.funfact');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.count').countTo();
                $(window).off('scroll.funfact');
            }
        });
    }

    /*========== end Counter To Js funfact   ==========*/

    /*========== Start dg Counter To Js funfact   ==========*/

    if ($('.funfact-two').length) {
        $(window).on('scroll.funfact-two', function () {
            var stat = $('.funfact-two');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.count-two').countTo();
                $(window).off('scroll.funfact-two');
            }
        });
    }

    /*========== end dg Counter To Js funfact   ==========*/



    if ($('.funfact-three').length) {
        $(window).on('scroll.funfact-three', function () {
            var stat = $('.funfact-three');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.count-three').countTo();
                $(window).off('scroll.funfact-three');
            }
        });
    }


    if ($('.hp4a-single-count').length) {
        $('.hp4a-single-count').appear(function() {
            var $t = $(this),
                n = $t.find(".count-text").attr("data-stop"),
                r = parseInt($t.find(".count-text").attr("data-speed"), 10);
            if (!$t.hasClass("counted")) {
                $t.addClass("counted");
                $({
                    countNum: $t.find(".count-text").text()
                }).animate({
                    countNum: n
                }, {
                    duration: r,
                    easing: "linear",
                    step: function() {
                        $t.find(".count-text").text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $t.find(".count-text").text(this.countNum);
                    }
                });
            }
        });
    }
    

            
    /*========== Start Portfolio isotop Js ==========*/
 // isotop
    // init Isotope
    var $grid = $('.custom-row').isotope({
        itemSelector: '.grid-item',
        percentPosition: true,
        masonry: {
            // use outer width of grid-sizer for columnWidth
            columnWidth: 1,
        }
    });

    
    // filter items on button click
    $('.portfolio-menu').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({
            filter: filterValue
        });
    });

    //for menu active class
    $('.portfolio-menu button').on('click', function (event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
    });

    // magnificPopup
    if ($('.projects-popup-link').length) {
        $('.projects-popup-link').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            },
        });
    }



    /*============================== start video element     ========================================*/

    // magnificPopup start
    $('.popup-youtube').magnificPopup({
        type: 'video',
    });

    // magnificPopup end


    /*video element one*/
    if ($('.video-inner-one').length) {
        $('.video-play-one').magnificPopup({
            type: 'video',
            gallery: {
                enabled: true
            },
        });
    }

    /*video element two*/
    if ($('.video-inner-two').length) {
        $('.video-play-two').magnificPopup({
            type: 'video',
            gallery: {
                enabled: true
            },
        });
    }

    /*video element three*/
    if ($('.video-inner-three').length) {
        $('.video-play-three').magnificPopup({
            type: 'video',
            gallery: {
                enabled: true
            },
        });
    }

    /*============================== end video element     ========================================*/

    // testimonial Carousel (testimonial one)
    if ($('.testimonial-carousel').length) {
        $('.testimonial-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            dats: false,
            animateOut: 'fadeOut',
            animateIn: 'fadeIn',
            autoHeight: true,
            smartSpeed: 500,
            autoplay: false,
            mouseDrag: false,
            navText: ['<span class="flaticon-right"></span>', '<span class="flaticon-back"></span>'],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                700: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }
    
    // testimonial Carousel (testimonial one)
 
    
    // Cloud testimonial Carousel 
    if ($('.cloud-testimonial-inner').length) {
        $('.cloud-testimonial-inner').owlCarousel({
            loop:true,
            margin:0,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            smartSpeed: 1000,
            autoplay: 5000,
            dots: true,
            nav: false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1200:{
                    items:1
                }
            }
        });
    }

    
    
    //Stacked Con-Cloud Testimonial Carousel
	if($('.stacked-testimonial-carousel').length){
		function slideSwitch() {
			var $active = $('.stacked-testimonial-carousel .slides .slide.active');
			if ($active.length == 0) $active = $('.stacked-testimonial-carousel .slides .slide:last');
			var $next =  $active.next().length ? $active.next() : $('.stacked-testimonial-carousel .slides .slide:first');
			$('.stacked-testimonial-carousel .slides .slide').removeClass('active');
			$next.addClass('active');
		}
		
		var myVar = setInterval(function(){slideSwitch();},5000);

		$('.stacked-testimonial-carousel .slides .slide').click(function() {
			var current = $(this).attr('class','slide');
			$('.stacked-testimonial-carousel .slides .slide').removeClass('active');
			$(current).addClass('active');
			clearInterval(myVar);
			slideSwitch();
		});
	}
	

    

    //  start tiny-slider testimonial-area two
    if ($('.testimonial-area-two').length) {

        var slider = tns({
          "container": "#testimonial-active",
          "items": 1,
          //"axis": "vertical",
          "controlsContainer": "#testi-controls-two",
          "navContainer": "#testi-thumbnails-two",
          "navAsThumbnails": true,
          "autoplay": true,
          "autoplayTimeout": 3000,
          "swipeAngle": false,
          "speed": 1000
        });
    }
    //  end tiny-slider testimonial-area two



    //Client carousel /partner-carousel
    if ($('.partner-carousel').length) {
        $('.partner-carousel.owl-carousel').owlCarousel({
            loop: true,
            margin: 50,
            nav: false,
            dots: false,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2,
                },
                575: {
                    items: 3,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                }
            }
        });
    }



    //Client element-carousel
    if ($('.partner-info-three').length) {
        $('.partner-info-three.owl-carousel').owlCarousel({
            loop: true,
            margin: 50,
            nav: true,
            dots: true,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: ['<span class="flaticon-left-chevron"></span>', '<span class="flaticon-right-chevron"></span>'],
            responsive: {
                0: {
                    items: 2,
                },
                575: {
                    items: 3,
                },
                768: {
                    items: 4,
                },
                992: {
                    items: 5,
                }
            }
        });
    }


    //home page four what we provide carousel
    if ($('.hp4-wwp-inner').length) {
        $('.hp4-wwp-inner').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: true,
            autoWidth: false,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            navText: ['<span class="flaticon-back"></span>', '<span class="flaticon-right"></span>'],
            responsive: {
                0: {
                    items: 1,
                },
                575: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3,
                }
            }
        });
    }

    
    //home page four Customer Feedback carousel
    if ($('.hp4-cf-inner').length) {
        $('.hp4-cf-inner').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            dots: true,
            autoWidth: false,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                575: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 2,
                }
            }
        });
    }


    // shop page banner slider start
    if ($('.product-banner-slider').length) {
        $('.product-banner-slider').owlCarousel({
            loop: true,
            nav: false,
            dots: false,
            items: 1,
            autoWidth: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
        });
    }
    // shop page banner slider end


//Jquery Spinner / Quantity Spinner
/*
    if($('.quantity-spinner').length){
        $("input.quantity-spinner").TouchSpin({
          verticalbuttons: true,
          verticalupclass: 'fa fa-angle-up',
          verticaldownclass: 'fa fa-angle-down'
        });
    }
*/
    
            // Number Input Minus on Click
        $(".minus").on('click', function () {
            this.parentNode.querySelector('input[type=number]').stepDown();
        });

        // Number Input Plus on Click
        $(".plus").on('click', function () {
            this.parentNode.querySelector('input[type=number]').stepUp();
        });





    //Accordion Box start
    if($('.accordion-box-one').length){
        $(".accordion-box-one").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-box-one .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-box-one .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box start
    if($('.accordion-box-two').length){
        $(".accordion-box-two").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-box-two .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-box-two .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box start
    if($('.accordion-three-white').length){
        $(".accordion-three-white").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-three-white .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-three-white .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box start
    if($('.accordion-three-gray').length){
        $(".accordion-three-gray").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-three-gray .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-three-gray .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box start
    if($('.accordion-box-five').length){
        $(".accordion-box-five").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-box-five .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-box-five .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box start
    if($('.accordion-box-six').length){
        $(".accordion-box-six").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accordion-box-six .accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accordion-box-six .accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        }); 
    }

    //Accordion Box end

    // checkout  Accordion start
    if($('.pament-option').length){
        $(".pament-option").on('click', '.accord-btn', function() {
        
            if($(this).hasClass('active')!==true){
            $('.accord-btn').removeClass('active');
            
            }
            
            if ($(this).next('.accord-content').is(':visible')){
                $(this).removeClass('active');
                $(this).next('.accord-content').slideUp(300);
            }else{
                $(this).addClass('active');
                $('.accord-content').slideUp(300);
                $(this).next('.accord-content').slideDown(300); 
            }
        });
    }

    // checkout Accordion end


/*checkout page niceselect plugin*/

    if($('.checkout-area').length){

        $('.custom-select-icon').niceSelect();

    }

/*apply-form page nice select */
    if($('.apply-form').length){

        $('.custom-select-icon').niceSelect();

    }


    /* Coming Soon CountDown Start */
    if($('.coming-soon-inner').length !== 0){
            const second = 1000,
              minute = second * 60,
              hour = minute * 60,
              day = hour * 24;
            let countDown = new Date('Jan 12, 2022 00:00:00').getTime(),
        x = setInterval(function() {
          let now = new Date().getTime(),
              distance = countDown - now;
            document.getElementById('days').innerText = Math.floor(distance / (day)),
            document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
            document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
          //do something later when date is reached
          //if (distance < 0) {
          //  clearInterval(x);
          //  'IT'S MY BIRTHDAY!;
          //}
        }, second)
    };
    /* Coming Soon CountDown End */






    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })


    /*========== Start Counter To Js skillbar one   ==========*/
    if ($('.skillbar1').length) {
        $(window).on('scroll.skillbar1', function () {
            var stat = $('.skillbar1');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.skillbar1').skillBars({
                    from: 0,
                    speed: 2000, 
                    interval: 100,
                    decimals: 0,
                });
                $(window).off('scroll.skillbar1');
            }
        });
    }


    /*========== Start Counter To Js skillbar two   ==========*/
    if ($('.skillbar2').length) {
        $(window).on('scroll.skillbar2', function () {
            var stat = $('.skillbar2');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.skillbar2').skillBars({
                    from: 0,
                    speed: 2000, 
                    interval: 100,
                    decimals: 0,
                });
                $(window).off('scroll.skillbar2');
            }
        });
    }

    /*========== Start Counter To Js skillbar three   ==========*/
    if ($('.skillbar3').length) {
        $(window).on('scroll.skillbar3', function () {
            var stat = $('.skillbar3');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {
                $('.skillbar3').skillBars({
                    from: 0,
                    speed: 2000, 
                    interval: 100,
                    decimals: 0,
                });
                $(window).off('scroll.skillbar3');
            }
        });
    }


    /*========== Start Counter To Js skillbar four circle   ==========*/
    if ($('.circle').length) {
        $(window).on('scroll.circle', function () {

            var stat = $('.circle');
            if ($(this).scrollTop() >= stat.offset().top - $(window).height() + 50) {

                /*first*/
                    $('.first.circle').circleProgress({
                        size: 150,
                        value: 0.6,
                        lineCap: 'round',
                        fill: {color: '#6563F7'}
                    }).on('circle-animation-progress', function(event, progress) {
                    $(this).find('.percent').html(Math.round(60 * progress) + '<i>%</i>');
                    });

                /*second*/
                  $('.second.circle').circleProgress({
                        size: 150,
                        value: 0.75,
                        lineCap: 'round',
                        fill: {color: '#6563F7'}
                  }).on('circle-animation-progress', function(event, progress) {
                    $(this).find('.percent').html(Math.round(75 * progress) + '<i>%</i>');
                  });

                /*third*/
                  $('.third.circle').circleProgress({
                        size: 150,
                        value: 0.9,
                        lineCap: 'round',
                        fill: {color: '#6563F7'}
                  }).on('circle-animation-progress', function(event, progress) {
                    $(this).find('.percent').html(Math.round(90 * progress) + '<i>%</i>');
                  });


            $(window).off('scroll.circle');
            }

        });
    }




// Scroll to a Specific Div
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function () {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

        });
    }

    /* ==========================================================================
       When document is scroll, do
       ========================================================================== */

    $(window).on('scroll', function () {
        headerStyle();
    });

    /* ==========================================================================
       When document is loaded, do
       ========================================================================== */

    $(window).on('load', function () {
        handlePreloader();

        /* Blog Isotope */
        $('.blog-masonry').isotope({
          // set itemSelector so .grid-sizer is not used in layout
          itemSelector: '.blog-masonry-item',
          percentPosition: true,
          masonry: {
            // use element for option
            columnWidth: '.blog-masonry-item',
          }
        });


    });


})(jQuery);