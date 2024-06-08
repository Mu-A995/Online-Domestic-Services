(function($) {

	"use strict";


    /*------------------------------------------
        = ALL ESSENTIAL FUNCTIONS
    -------------------------------------------*/

    // Toggle mobile navigation
    function toggleMobileNavigation() {
        var navbar = $(".navigation-holder");
        var openBtn = $(".navbar-header .open-btn");
        var closeBtn = $(".navigation-holder .close-navbar");
        var body = $(".page-wrapper");

        openBtn.on("click", function() {
            if (!navbar.hasClass("slideInn")) {
                navbar.addClass("slideInn");
                body.addClass("body-overlay");
            }
            return false;
        })

        closeBtn.on("click", function() {
            if (navbar.hasClass("slideInn")) {
                navbar.removeClass("slideInn");
            }
            body.removeClass("body-overlay");
            return false;
        })
    }

    toggleMobileNavigation();


    // Function for toggle class for small menu
    function toggleClassForSmallNav() {
        var windowWidth = window.innerWidth;
        var mainNav = $("#navbar > ul");

        if (windowWidth <= 991) {
            mainNav.addClass("small-nav");
        } else {
            mainNav.removeClass("small-nav");
        }
    }

    toggleClassForSmallNav();


    // Function for small menu
    function smallNavFunctionality() {
        var windowWidth = window.innerWidth;
        var mainNav = $(".navigation-holder");
        var smallNav = $(".navigation-holder > .small-nav");
        var subMenu = smallNav.find(".sub-menu");
        var megamenu = smallNav.find(".mega-menu");
        var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

        if (windowWidth <= 991) {
            subMenu.hide();
            megamenu.hide();
            menuItemWidthSubMenu.on("click", function(e) {
                var $this = $(this);
                $this.siblings().slideToggle();
                 e.preventDefault();
                e.stopImmediatePropagation();
            })
        } else if (windowWidth > 991) {
            mainNav.find(".sub-menu").show();
            mainNav.find(".mega-menu").show();
        }
    }

    smallNavFunctionality();


    // Parallax background
    function bgParallax() {
        if ($(".parallax").length) {
            $(".parallax").each(function() {
                var height = $(this).position().top;
                var resize     = height - $(window).scrollTop();
                var doParallax = -(resize/5);
                var positionValue   = doParallax + "px";
                var img = $(this).data("bg-image");

                $(this).css({
                    backgroundImage: "url(" + img + ")",
                    backgroundPosition: "50%" + positionValue,
                    backgroundSize: "cover"
                });
            });
        }
    }

    // HERO SLIDER
    var menu = [];
    jQuery('.swiper-slide').each( function(index){
        menu.push( jQuery(this).find('.slide-inner').attr("data-text") );
    });
    var interleaveOffset = 0.5;
    var swiperOptions = {
        loop: true,
        speed: 1000,
        parallax: true,
        autoplay: {
            delay: 6500,
            disableOnInteraction: false,
        },
        watchSlidesProgress: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        on: {
            progress: function() {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    var slideProgress = swiper.slides[i].progress;
                    var innerOffset = swiper.width * interleaveOffset;
                    var innerTranslate = slideProgress * innerOffset;
                    swiper.slides[i].querySelector(".slide-inner").style.transform =
                    "translate3d(" + innerTranslate + "px, 0, 0)";
                }      
            },

            touchStart: function() {
              var swiper = this;
              for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = "";
              }
            },

            setTransition: function(speed) {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    swiper.slides[i].style.transition = speed + "ms";
                    swiper.slides[i].querySelector(".slide-inner").style.transition =
                    speed + "ms";
                }
            }
        }
    };

    var swiper = new Swiper(".swiper-container", swiperOptions);

    // DATA BACKGROUND IMAGE
    var sliderBgSetting = $(".slide-bg-image");
    sliderBgSetting.each(function(indx){
        if ($(this).attr("data-background")){
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });



    /*------------------------------------------
        = HIDE PRELOADER
    -------------------------------------------*/
    // function preloader() {
    //     if($('.preloader').length) {
    //         $('.preloader').delay(100).fadeOut(500, function() {

    //             //active wow
    //             wow.init();

    //             // product landing hero watch animation
    //             // if ($(".hero-pic").length) {
    //             //     $(".hero-pic").addClass("hero-pic-animation");
    //             // }

    //         });
    //     }
    // }


    /*------------------------------------------
        = WOW ANIMATION SETTING
    -------------------------------------------*/
    var wow = new WOW({
        boxClass:     'wow',      // default
        animateClass: 'animated', // default
        offset:       0,          // default
        mobile:       true,       // default
        live:         true        // default
    });


    /*------------------------------------------
        = ACTIVE POPUP IMAGE
    -------------------------------------------*/
    if ($(".fancybox").length) {
        $(".fancybox").fancybox({
            openEffect  : "elastic",
            closeEffect : "elastic",
            wrapCSS     : "project-fancybox-title-style"
        });
    }


    /*------------------------------------------
        = POPUP VIDEO
    -------------------------------------------*/
    if ($(".video-btn").length) {
        $(".video-btn").on("click", function(){
            $.fancybox({
                href: this.href,
                type: $(this).data("type"),
                'title'         : this.title,
                helpers     : {
                    title : { type : 'inside' },
                    media : {}
                },

                beforeShow : function(){
                    $(".fancybox-wrap").addClass("gallery-fancybox");
                }
            });
            return false
        });
    }


    /*------------------------------------------
        = ACTIVE GALLERY POPUP IMAGE
    -------------------------------------------*/
    if ($(".popup-gallery").length) {
        $('.popup-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',

            gallery: {
              enabled: true
            },

            zoom: {
                enabled: true,

                duration: 300,
                easing: 'ease-in-out',
                opener: function(openerElement) {
                    return openerElement.is('img') ? openerElement : openerElement.find('img');
                }
            }
        });
    }


    /*------------------------------------------
        = FUNCTION FORM SORTING GALLERY
    -------------------------------------------*/
    function sortingGallery() {
        if ($(".sortable-gallery .gallery-filters").length) {
            var $container = $('.gallery-container');
            $container.isotope({
                filter:'*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false,
                }
            });

            $(".gallery-filters li a").on("click", function() {
                $('.gallery-filters li .current').removeClass('current');
                $(this).addClass('current');
                var selector = $(this).attr('data-filter');
                $container.isotope({
                    filter:selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false,
                    }
                });
                return false;
            });
        }
    }

    sortingGallery();


    /*------------------------------------------
        = MASONRY GALLERY SETTING
    -------------------------------------------*/
    function masonryGridSetting() {
        if ($('.masonry-gallery').length) {
            var $grid =  $('.masonry-gallery').masonry({
                itemSelector: '.grid-item',
                columnWidth: '.grid-item',
                percentPosition: true
            });

            $grid.imagesLoaded().progress( function() {
                $grid.masonry('layout');
            });
        }
    }

    // masonryGridSetting();


    /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/
    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
        $ele.addClass('original').clone().insertAfter($ele).addClass($newElmClass).removeClass('original');
    }

    // clone home style 1 navigation for sticky menu
    if ($('.site-header .navigation').length) {
        cloneNavForSticyMenu($('.site-header .navigation'), "sticky-header");
    }

    var lastScrollTop = '';

    function stickyMenu($targetMenu, $toggleClass) {
        var st = $(window).scrollTop();
        var mainMenuTop = $('.site-header .navigation');

        if ($(window).scrollTop() > 1000) {
            if (st > lastScrollTop) {
                // hide sticky menu on scroll down
                $targetMenu.removeClass($toggleClass);

            } else {
                // active sticky menu on scroll up
                $targetMenu.addClass($toggleClass);
            }

        } else {
            $targetMenu.removeClass($toggleClass);
        }

        lastScrollTop = st;
    }


    /*------------------------------------------
        = HEADER SEARCH AREA
    -------------------------------------------*/
    if ($(".header-search-area").length) {
        var serachFormBox = $(".header-search-area .header-search-form");
        var openSeachBtn = $(".header-search-area .open-btn");
        
        $(document.body).append(serachFormBox);
        serachFormBox.hide();

        openSeachBtn.on("click", function(e) {
            serachFormBox.fadeIn();
            return false;
        });

        serachFormBox.on("click", function() {
            serachFormBox.fadeOut();
            return false;
        }).find(".form").on("click", function(e) {
            e.stopPropagation();
        })
    }


    /*------------------------------------------
        = SERVICES SLIDER
    -------------------------------------------*/
    if ($(".services-slider").length) {
        $(".services-slider").owlCarousel({
            loop:true,
            margin: 30,
            dots: false,
            nav: true,
            navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next"></i>'],
            smartSpeed: 500,
            responsive:{
                0 : {
                    items: 1,
                },
                
                550 : {
                    items: 2,
                    center: false,
                    margin: 10
                },
                
                992 : {
                    items: 3,
                    center: false,
                    margin: 10
                },
                
                1400:{
                    items:3
                }
            }
        });
    }


    /*------------------------------------------
        = PROJECTS SLIDER
    -------------------------------------------*/
    if ($(".projects-slider").length) {
        $(".projects-slider").owlCarousel({
            autoplay: true,
            loop:true,
            dots: false,
            smartSpeed: 500,
            nav: true,
            navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next"></i>'],
            responsive:{
                0 : {
                    items: 1,
                },
                
                550 : {
                    items: 2,
                    center: false,
                    margin: 10
                },
                
                892:{
                    items:3
                },
                
                1200:{
                    items:4
                },
                
                1400:{
                    items:5
                }
            }
        });
    }


    /*------------------------------------------
        = PROJECTS SLIDER S2
    -------------------------------------------*/
    if ($(".projects-slider-s2").length) {
        $(".projects-slider-s2").owlCarousel({
            autoplay: true,
            loop:true,
            dots: false,
            smartSpeed: 500,
            nav: true,
            navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next"></i>'],
            responsive:{
                0 : {
                    items: 1,
                },
                
                550 : {
                    items: 2,
                    center: false,
                    margin: 10
                },
                
                892:{
                    items:3
                }
            }
        });
    }


    /*------------------------------------------
        = TESTIMONIALS SLIDER
    -------------------------------------------*/
    if ($(".testimonials-slider").length) {
        $(".testimonials-slider").owlCarousel({
            items: 1,
            autoplay: false,
            loop:true,
            smartSpeed: 1000,
        });
    }


    /*-------------------------------------------------------
        = ABOUT-SECTION-S2 IMAGE BG SETTING
    -----------------------------------------------------*/
    if ($(".about-section-s2 .about-row").length) {

        var imgHolder = $(".about-section-s2 .about-row .img-holder");

        imgHolder.each(function() {
            var $this = $(this);
            var imgHolderPic = $this.find("img").attr("src");

            $this.css({
                backgroundImage: "url("+ imgHolderPic +")",
                backgroundSize: "cover",
                backgroundPosition: "center center"
            })
        })
    }



    /*------------------------------------------
        = TESTIMONIALS SLIDER S2
    -------------------------------------------*/
    if ($(".testimonials-slider-s2").length) {
        $(".testimonials-slider-s2").owlCarousel({
            loop:true,
            smartSpeed: 500,
            margin: 30,
            responsive:{
                0 : {
                    items: 1,
                },
                
                600 : {
                    items: 2,
                    center: false,
                    margin: 10
                }
            }
        });
    }


    /*------------------------------------------
        = PARTNERS SLIDER
    -------------------------------------------*/
    if ($(".partners-slider").length) {
        $(".partners-slider").owlCarousel({
            autoplay:true,
            smartSpeed: 300,
            margin: 30,
            loop:true,
            autoplayHoverPause:true,
            dots: false,
            responsive: {
                0 : {
                    items: 2
                },

                550 : {
                    items: 3
                },

                992 : {
                    items: 4
                },

                1200 : {
                    items: 5
                }
            }
        });
    }


    /*------------------------------------------
        = POST SLIDER
    -------------------------------------------*/
    if($(".post-slider".length)) {
        $(".post-slider").owlCarousel({
            mouseDrag: false,
            smartSpeed: 500,
            margin: 30,
            loop:true,
            nav: true,
            navText: ['<i class="fi flaticon-back"></i>','<i class="fi flaticon-next"></i>'],
            dots: false,
            items: 1
        });
    }  
    
    
    // set two coloumn height equial
    function setTwoColEqHeight($col1, $col2) {
        var firstCol = $col1,
            secondCol = $col2,
            firstColHeight = $col1.innerHeight(),
            secondColHeight = $col2.innerHeight();

        if (firstColHeight > secondColHeight) {
            secondCol.css({
                "height": firstColHeight + 1 + "px"
            })
        } else {
            firstCol.css({
                "height": secondColHeight + 1 + "px"
            })
        }
    }


    /*------------------------------------------
        = CONTACT FORM SUBMISSION
    -------------------------------------------*/
    if ($("#contact-form-small").length) {
        $("#contact-form-small").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },

                email: "required",

                phone: "required",
                
                subject: {
                    required: true
                }

            },

            messages: {
                name: "Please enter your name",
                email: "Please enter your email address",
                phone: "Please enter your phone number",
                subject: "Please select your contact subject"
            },

            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "mail-contact-small.php",
                    data: $(form).serialize(),
                    success: function () {
                        $( "#loader").hide();
                        $( "#success").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#success").slideUp( "slow" );
                        }, 3000);
                        form.reset();
                    },
                    error: function() {
                        $( "#loader").hide();
                        $( "#error").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#error").slideUp( "slow" );
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    if ($("#contact-form-main").length) {
        $("#contact-form-main").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },

                email: "required",

                phone: "required",
                
                subject: {
                    required: true
                }

            },

            messages: {
                name: "Please enter your name",
                email: "Please enter your email address",
                phone: "Please enter your phone number",
                subject: "Please select your contact subject"
            },

            submitHandler: function (form) {
                $.ajax({
                    type: "POST",
                    url: "mail-contact.php",
                    data: $(form).serialize(),
                    success: function () {
                        $( "#loader").hide();
                        $( "#success").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#success").slideUp( "slow" );
                        }, 3000);
                        form.reset();
                    },
                    error: function() {
                        $( "#loader").hide();
                        $( "#error").slideDown( "slow" );
                        setTimeout(function() {
                        $( "#error").slideUp( "slow" );
                        }, 3000);
                    }
                });
                return false; // required to block normal submit since you used ajax
            }

        });
    }


    /*==========================================================================
        WHEN DOCUMENT LOADING
    ==========================================================================*/
        $(window).on('load', function() {

            // preloader();

            //sliderBgSetting();

            toggleMobileNavigation();

            smallNavFunctionality();

            if($(".about-section-s2").length) {
                setTwoColEqHeight($(".about-section-s2 .about-row .img-holder"), $(".about-section-s2 .about-row .details"));
            }

            if($(".about-section-s3").length) {
                setTwoColEqHeight($(".about-section-s3 .about-grids .img-holder"), $(".about-section-s3 .about-grids .last-grid"));
            }

        });



    /*==========================================================================
        WHEN WINDOW SCROLL
    ==========================================================================*/
    $(window).on("scroll", function() {

		if ($(".site-header").length) {
            stickyMenu( $('.site-header .navigation'), "sticky-on" );
        }
    });


    /*==========================================================================
        WHEN WINDOW RESIZE
    ==========================================================================*/
    $(window).on("resize", function() {
        
        toggleClassForSmallNav();

        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function() {
            smallNavFunctionality();
        }, 200));
    });


})(window.jQuery);
