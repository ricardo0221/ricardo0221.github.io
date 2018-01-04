(function ($) {
    "use strict";

    /**
     * Back to top
     */
    $("body").append('<div class="backtotop"><i class="fa fa-angle-up" aria-hidden="true"></i></div>');
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) {
            $('.backtotop').fadeIn();
        } else {
            $('.backtotop').fadeOut();
        }
    });

    $(".backtotop").click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
    }); // End back to top

    /**
     * Add slidedown animation to dropdown
     */
    if ($(window).width() > 769) {
        $('.navbar .dropdown').hover(function () {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

        }, function () {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

        });
    }

    var site_url = store99_url.site_url;

    /**
     * Hot products owlCarousel
     */
    $("#hot-product").owlCarousel({
        items: 1,
        loop: true,
        autoPlay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false
    });

    /**
     * New arrival owlCarousel
     */
    $("#new-arrival").owlCarousel({
        items: 1,
        loop: true,
        autoPlay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsTabletSmall: true,
        itemsMobile: [539, 1]
    });

    /**
     * Category with products owlCarousel
     */
    $(".category-with-products").owlCarousel({
        items: 4,
        loop: true,
        autoPlay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true
            },
            539: {
                items: 1,
                nav: false,
                dots: true
            },
            768: {
                items: 2,
                nav: true,
                dots: false
            },
            1199: {
                items: 4,
                nav: true,
                loop: false
            }
        }
    });

    /**
     * Blog owlCarousel
     */
    $("#blog").owlCarousel({
        items: 1,
        loop: true,
        autoPlay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 2],
        itemsTablet: [768, 2],
        itemsTabletSmall: true,
        itemsMobile: [539, 1]
    });

    /**
     * Brand owlCarousel
     */
    $("#brand").owlCarousel({
        items: 1,
        loop: true,
        autoPlay: true,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: false
    });

    function DropDown(el) {
        this.dd = el;
        this.initEvents();
    }

    /**
     * Dropdown function
     * @type {{initEvents: DropDown.initEvents}}
     */
    DropDown.prototype = {
        initEvents: function () {
            var obj = this;

            obj.dd.on('click', function (event) {
                $(this).toggleClass('active');
                event.stopPropagation();
            });
        }
    };

    var dd = new DropDown($('#dd'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-5').removeClass('active');
    });

    /**
     * Woocommerce Viewing
     */
    $('.woocommerce-viewing').on('change', function () {
        $(this).submit();
    });

    /**
     * Woocommerce Grid/List Toggle
     */
    $(document).on('click', '#grid', function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#list').removeClass('active');

        var $toggle = $('.gridlist-toggle');
        if ($toggle.length) {
            var $products = $('ul.products');
            $products.fadeOut(300, function () {
                $products.addClass('grid').removeClass('list').fadeIn(300);
            });
        }
    });

    $(document).on('click', '#list', function (e) {
        e.preventDefault();
        $(this).addClass('active');
        $('#grid').removeClass('active');

        var $toggle = $('.gridlist-toggle');
        if ($toggle.length) {
            var $products = $('ul.products');
            $products.fadeOut(300, function () {
                $products.addClass('list').removeClass('grid').fadeIn(300);
                // $products.find('li').addClass('clearfix');
                // $products.closest(".product-title, .star-rating, .price, .add-links-wrap").wrapAll($('<div>').addClass('wrap'));
            });
        }
    });

    /**
     * Product Search
     */
    var products = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: site_url + '/wp-admin/admin-ajax.php?action=store99_search_ajax_call&query=%QUERY',
            wildcard: '%QUERY',
            replace: function (url, uriEncodedQuery) {
                var val = $(".search-from-categories option:selected").val();
                if (!val) return url.replace("%QUERY", uriEncodedQuery);
                return url.replace("%QUERY", uriEncodedQuery) + '&category=' + encodeURIComponent(val);
            },
            cache: false
        }
    });

    var typehead_selector = $('.search-input');

    typehead_selector.typeahead(
        {
            hint: false,
            highlight: true,
            minLength: 1
        },
        {
            name: 'product',
            display: 'title',
            source: products
        }
    ).on('typeahead:asyncrequest', function () {
        typehead_selector.addClass('search-loading');
    }).on('typeahead:render', function () {
        typehead_selector.removeClass('search-loading');
    }).on('typeahead:select', function ($e, item) {
        window.location.href = item.slug;
    });

    /**
     * Mini cart events
     */
    $('.middle .add-card').on('mouseover', function (e) {
        e.preventDefault();
        $('.cart-popup').addClass('shopping-cart-show');
    });
    $('.middle .add-card').on('mouseout', function (e) {
        e.preventDefault();
        $('.cart-popup').removeClass('shopping-cart-show');
    });
    $('.cart-popup').on('mouseover', function (e) {
        e.preventDefault();
        $('.cart-popup').addClass('shopping-cart-show');
    });
    $('.cart-popup').on('mouseout', function (e) {
        e.preventDefault();
        $('.cart-popup').removeClass('shopping-cart-show');
    });

    /**
     * Initialise Bootstrap Carousel Touch Slider
     */
    $('#bootstrap-touch-slider').bsTouchSlider();

}(jQuery));

// preloader
jQuery(window).load(function () {
    jQuery('.preloader').delay(400).fadeOut(500);
});