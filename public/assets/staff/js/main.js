$(document).ready(function () {

    /* float label checking input is not empty */
    $('.float-label .form-control').on('blur', function () {
        if ($(this).val() || $(this).val().length != 0) {
            $(this).closest('.float-label').addClass('active');
        } else {
            $(this).closest('.float-label').removeClass('active');
        }
    })

    /* menu open close wrapper screen click close menu */
    $('.menu-btn').on('click', function (e) {
        e.stopPropagation();
        if ($('body').hasClass('sidemenu-open') == true) {
            $('body, html').removeClass('sidemenu-open');
            setTimeout(function () {
                $('body, html').removeClass('menuactive');
            }, 500);
        } else {
            $('body, html').addClass('sidemenu-open menuactive');
        }
    });
    $('.wrapper, .closesidemenu').on('click', function () {

        if ($('body').hasClass('sidemenu-open') == true) {

            $('body, html').removeClass('sidemenu-open');
            setTimeout(function () {
                $('body, html').removeClass('menuactive');
            }, 500);
        }
    });

    /* filter click open filter */
    if ($('body').hasClass('filtermenu-open') == true) {
        $('.filter-btn').find('i').html('close');
    }
    $('.filter-btn').on('click', function () {
        if ($('body').hasClass('filtermenu-open') == true) {
            $('body').removeClass('filtermenu-open');
            $(this).find('i').html('filter_list')

        } else {
            $('body').addClass('filtermenu-open');
            $(this).find('i').html('close')
        }
    });

    /* background image to cover */
    $('.background').each(function () {
        var imagewrap = $(this);
        var imagecurrent = $(this).find('img').attr('src');
        imagewrap.css('background-image', 'url("' + imagecurrent + '")');
        $(this).find('img').remove();
    });

    /* drag and scroll like mobile remove while creating mobile app */
    (function ($) {
        $.dragScroll = function (options) {
            var settings = $.extend({
                scrollVertical: true,
                scrollHorizontal: true,
                cursor: null
            }, options);

            var clicked = false,
                clickY, clickX;

            var getCursor = function () {
                if (settings.cursor) return settings.cursor;
                if (settings.scrollVertical && settings.scrollHorizontal) return 'url(img/touch.png), move';
                if (settings.scrollVertical) return 'row-resize';
                if (settings.scrollHorizontal) return 'col-resize';
            }

            var updateScrollPos = function (e, el) {
                $('html').css('cursor', getCursor());
                var $el = $(el);
                settings.scrollVertical && $el.scrollTop($el.scrollTop() + (clickY - e.pageY));
                settings.scrollHorizontal && $el.scrollLeft($el.scrollLeft() + (clickX - e.pageX));
            }

            $(document).on({
                'mousemove': function (e) {
                    clicked && updateScrollPos(e, this);
                },
                'mousedown': function (e) {
                    clicked = true;
                    clickY = e.pageY;
                    clickX = e.pageX;
                },
                'mouseup': function () {
                    clicked = false;
                    $('html').css('cursor', 'url(img/logo-cursor.png), auto');
                }
            });
        }
    }(jQuery))

    $.dragScroll();
    /* End of drag and scroll like mobile remove while creating mobile app */

    /* theme color cookie */
    if ($.type($.cookie("theme-color")) != 'undefined' && $.cookie("theme-color") != '') {
        $('html').removeClass('blue-theme deeppurple-theme orange-theme pink-theme');
        $('html').addClass($.cookie("theme-color"));
    }
    $('.theme-color .btn').on('click', function () {
        $('html').removeClass('blue-theme');
        $('html').removeClass($.cookie("theme-color"));
        $.cookie("theme-color", $(this).attr('data-theme'), {
            expires: 1
        });
        $('html').addClass($.cookie("theme-color"));
    });

    /* theme layout cookie */
    if ($.type($.cookie("theme-color-layout")) === 'theme-dark' && $.cookie("theme-color-layout") == 'theme-dark') {
        $('#theme-dark').prop('checked', true);
        $('html').addClass($.cookie("theme-color-layout"));
    } else {
        $('#theme-dark').prop('checked', false);
        $('html').addClass($.cookie("theme-color-layout"));
    }
    $('#theme-dark').on('change', function () {
        if ($(this).is(':checked') === true) {
            $('html').removeClass('theme-light');
            $('html').removeClass($.cookie("theme-color-layout"));
            $.cookie("theme-color-layout", 'theme-dark', {
                expires: 1
            });
            $('html').addClass($.cookie("theme-color-layout"));
        } else {
            $('html').removeClass('theme-dark');
            $('html').removeClass($.cookie("theme-color-layout"));
            $.cookie("theme-color-layout", 'theme-light', {
                expires: 1
            });
            $('html').addClass($.cookie("theme-color-layout"));
        }
    });

    /* theme RTL support */
    if ($.type($.cookie("rtl-layout")) !== 'rtl' && $.cookie("rtl-layout") !== 'rtl') {
        $('#theme-rtl').prop('checked', false);
        $('html').removeClass($.cookie("rtl-layout"));
    } else {
        $('#theme-rtl').prop('checked', true);
        $('html').addClass($.cookie("rtl-layout"));
    }

    $('#theme-rtl').on('change', function () {
        if ($(this).is(':checked') === true) {
            $.cookie("rtl-layout", 'rtl', {
                expires: 1
            });
            $('html').addClass($.cookie("rtl-layout"));
        } else {
            $('html').removeClass($.cookie("rtl-layout"));
            $.cookie("rtl-layout", 'ltr', {
                expires: 1
            });
            $('html').addClass($.cookie("rtl-layout"));
        }
    });
});

$(window).on('load', function () {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
    
    $('.loader-screen').fadeOut('slow');

    /* header active on scroll more than 50 px*/
    if ($(this).scrollTop() >= 30) {
        $('.header').addClass('active')
    } else {
        $('.header').removeClass('active')
    }

    $(window).on('scroll', function () {
        /* header active on scroll more than 50 px*/
        if ($(this).scrollTop() >= 30) {
            $('.header').addClass('active')
        } else {
            $('.header').removeClass('active')
        }
    });

    /* login row */
    $('.login-row').css('min-height', ($(window).height() - 80));


    /* page load itdetify for page level scripts */
    if ($(".pagethankyou").length) {
        setTimeout(function () {
            window.location.href = "index.html";
        }, 2000);
    }

    if ($(".homepage").length) {
        /* swiper slider carousel */
        var swiper = new Swiper('.icon-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
        });
        var swiper = new Swiper('.offer-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
        });

        var swiper = new Swiper('.two-slide', {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
            },
        });

        var swiper = new Swiper('.news-slide', {
            slidesPerView: 5,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
            },
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 0,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 0,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 0,
                }
            }
        });

        /* notification view and hide */
        setTimeout(function () {
            $('.notification').addClass('active');
            setTimeout(function () {
                $('.notification').removeClass('active');
            }, 3500);
        }, 500);
        $('.closenotification').on('click', function () {
            $(this).closest('.notification').removeClass('active')
        });
    }

    if ($(".walletpage").length) {
        /* swiper slider carousel */
        var swiper = new Swiper('.card-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
            },
        });
        var swiper = new Swiper('.offer-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
        });

    }

    if ($(".profilepage").length) {
        /* swiper slider */
        var swiper = new Swiper('.two-slide', {
            slidesPerView: 2,
            spaceBetween: 0,
            pagination: {
                el: '.swiper-pagination',
            },
        });

        var swiper = new Swiper('.offer-slide', {
            slidesPerView: 'auto',
            spaceBetween: 0,
        });
    }


    if ($(".homepage").length) {

    }

});

$(window).on('resize', function () {
    /* login row */
    $('.login-row').css('min-height', ($(window).height() - 80));
});