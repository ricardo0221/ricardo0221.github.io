jQuery(document).ready(function($){
     "use strict";    
    wp.customize( 'trendpress_about_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_about_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_about_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_about_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_feature_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_feature_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_feature_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_feature_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_team_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_team_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_team_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_team_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_portfolio_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_portfolio_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_portfolio_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_portfolio_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_blog_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_blog_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_blog_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_blog_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_shop_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_shop_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_shop_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_shop_section .section-sub-title h2' ).html( newval );
		} );
	} );
     wp.customize( 'trendpress_testimonial_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_testimonial_section .section-title h5' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_testimonial_sub_title', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_testimonial_section .section-sub-title h2' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_top_footer_description', function( value ) {
		value.bind( function( newval ) {
			$( '.top-footer-desc' ).html( newval );
		} );
	} );
     wp.customize( 'trendpress_footer_text', function( value ) {
		value.bind( function( newval ) {
			$( 'span.text-input' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_cta_title', function( value ) {
		value.bind( function( newval ) {
			$( '.content-title-cta' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_cta_section_description', function( value ) {
		value.bind( function( newval ) {
			$( '.content-desc-cta' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_cta_button_text', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_cta_section .cta-button1 a' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_cta_button_text2', function( value ) {
		value.bind( function( newval ) {
			$( '#trendpress_cta_section .cta-button2 a' ).html( newval );
		} );
	} );
    wp.customize( 'trendpress_body_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'body, .tp-about-content, .posts-content-main .tp-desc-wrap, .member-description, .blog_section .blogs-loop .blog-content, .testimonial_section .tp-desc-testimonial, .top-footer-desc' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h1_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h1' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h2_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h2' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h3_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h3' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h4_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h4' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h5_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h5' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_h6_font_size', function( value ) {
		value.bind( function( newval ) {
			$( 'h6' ).attr( 'style','font-size:'+newval+'px !important' );
		} );
	} );
    wp.customize( 'trendpress_body_font', function( value ) {
		value.bind( function( font ) {
			$( 'body' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h1_font', function( value ) {
		value.bind( function( font ) {
			$( 'h1' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h2_font', function( value ) {
		value.bind( function( font ) {
			$( 'h2' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h3_font', function( value ) {
		value.bind( function( font ) {
			$( 'h3' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h4_font', function( value ) {
		value.bind( function( font ) {
			$( 'h4' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h5_font', function( value ) {
		value.bind( function( font ) {
			$( 'h5' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
    wp.customize( 'trendpress_h6_font', function( value ) {
		value.bind( function( font ) {
			$( 'h6' ).attr( 'style', 'font-family: '+font+' !important' );
                WebFont.load({
                    google: {
                      families: [font]
                    }
              });
		} );
	} );
});