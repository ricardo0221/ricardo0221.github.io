jQuery(document).ready(function($){
 "use strict";
    
//Navigation toggle
$("#toggle").click(function () {
    $(this).toggleClass("on");
    $("#primary-menu").slideToggle();
});

var $grid = $('.portfolio-postse').imagesLoaded( function() {
  // init Isotope after all images have loaded
  $grid.isotope({
    itemSelector: '.portfolio-post-wrape',
    layoutMode: 'packery',
  });
});

$('.portfolio-post-filter').on( 'click', '.filter', function() {
    $('.portfolio-post-filter .filter').removeClass('active');
    $(this).addClass('active');
    var filterValue = $(this).attr('data-filter');
    $('.portfolio-postse').isotope({ filter: filterValue });
});

/** Header Slider **/
$("#secondary-wrap").owlCarousel({
    nav:true,
    margin: 50,
    items:1
});

$(".tp-test-secondary-wrap").owlCarousel({
    nav:true,
    responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:3
            },
            1000:{
                items:3
            }
        }
});
$("#blog-content-wrap").owlCarousel({
    nav:true,
    responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:3
            },
            1000:{
                items:3
            }
        }
});
$(".team-members").owlCarousel({
    nav:true,
    responsive:{
          0:{
                items:1
            },
            360:{
                items:1
            },
             411:{
                items:1
            },
            435:{
                items:1
            },
            500:{
                items:2
            },
            650:{
                items:3
            },
            1000:{
                items:4
            }
        }
});
$(".tp-logo-wrap").owlCarousel({
    nav:true,
    responsive:{
          0:{
                items:1
            },
            360:{
                items:2
            },
             411:{
                items:2
            },
            435:{
                items:3
            },
            500:{
                items:4
            },
            650:{
                items:5
            },
            1000:{
                items:6
            }
        }
});
/** Search Toggle **/
var open = false;
  $('.search-icon').on('click',function(){
    open = !open;
    if(open){
      $('.ak-search').show();
      $(this).find('i.fa4').removeClass('fa-search').addClass('fa-caret-right');
    }else{
      $('.ak-search').hide();
      $(this).find('i.fa4').addClass('fa-search').removeClass('fa-caret-right');
    }
  });
  
//Entrance WOW JS
var wow = new WOW(
    {
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 150, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function (box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        }
    }
);
wow.init();

// Parallax Background
setTimeout(function(){
   $('#trendpress_cta_section').parallax('50%', 0.4, true);
   $('.header-banner-container').parallax('50%', 0.4, true); 
}, 3000 );
});
