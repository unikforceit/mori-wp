/* -----------------------------------------------------------------------------
File:           JS Core
Version:        1.0
Last change:    00/00/00 
-------------------------------------------------------------------------------- */
(function ($) {

    "use strict";

    var Mori = {
        init: function () {
            this.Basic.init();
        },

        Basic: {
            init: function () {

                this.preloader();
                this.BackgroundImage();
                this.MobileMenu();
                this.cartModal();
                this.scrollTop();
                this.Animation();
                this.Niceselect();
                this.Tools();
                this.searchPopup();
            },
            preloader: function () {
                $(window).on('load', function () {
                    $(".preloader").fadeOut("slow");
                    $(".preloader").remove();
                });
            },
            BackgroundImage: function () {
                $('[data-background]').each(function () {
                    $(this).css('background-image', 'url(' + $(this).attr('data-background') + ')');
                });
            },
            Animation: function () {
                var wow = new WOW({
                    boxClass: 'wow', // animated element css class (default is wow)
                    animateClass: 'animated', // animation css class (default is animated)
                    offset: 0, // distance to the element when triggering the animation (default is 0)
                    mobile: true, // trigger animations on mobile devices (default is true)
                    live: true, // act on asynchronously loaded content
                });
                wow.init();
            },
            //  Menu inner search
            searchPopup: function () {
                $('.search-trigger').on('click', function (e) {
                    e.preventDefault();
                    $('.search-popup').addClass('open')
                });
                $('.close-trigger').on('click', function () {
                    $('.search-popup').removeClass('open')
                });
            },

            MobileMenu: function () {
                jQuery(window).on('scroll', function () {
                    if (jQuery(window).scrollTop() > 250) {
                        jQuery('.main-header').addClass('sticky-on')
                    } else {
                        jQuery('.main-header').removeClass('sticky-on')
                    }
                });
                $('.open_mobile_menu').on("click", function () {
                    $('.mobile_menu_wrap').toggleClass("mobile_menu_on");
                });
                $('.open_mobile_menu').on('click', function () {
                    $('body').toggleClass('mobile_menu_overlay_on');
                });
                if ($('.mobile_menu li.dropdown ul').length) {
                    $('.mobile_menu li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
                    $('.mobile_menu li.dropdown .dropdown-btn').on('click', function () {
                        $(this).prev('ul').slideToggle(500);
                    });
                }
            },
            Tools: function () {
                $('.menu-search button').on("click", function () {
                    $('.menu-search input[type="search"]').toggleClass("search-visible");
                });

                $('.expert-doctor-img .icon').on("click", function (event) {
                    event.preventDefault();
                    $('.expert-doctor-img').toggleClass("social-visible");
                });
                var galleryThumbs = new Swiper('.product-image-slider', {
                    slidesPerView: "auto",
                    spaceBetween: 10,
                    loop: true,
                    centeredSlides: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            },
            // cart modal js
            cartModal: function () {
                $('.cart-open').click( function (){
                    $('body').addClass('cart-activee');
                });
                $('.cart-overlay, .cart-close').click( function (){
                    $('body').removeClass('cart-activee');
                });
            },
            Niceselect: function () {
                $('select').niceSelect();
            },
            scrollTop: function () {
                $(window).on("scroll", function () {
                    var ScrollBarPosition = $(this).scrollTop();
                    if (ScrollBarPosition > 200) {
                        $(".scroll-top").fadeIn();
                    } else {
                        $(".scroll-top").fadeOut();
                    }
                });
                $(".scroll-top").on("click", function () {
                    $('body,html').animate({
                        scrollTop: 0,
                    });
                })
            },
        }
    };
    jQuery(document).ready(function () {
        Mori.init();
    });
})(jQuery);