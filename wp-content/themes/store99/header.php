<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Store_99
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( get_theme_mod( 'store99_enable_loading_overlay', true ) != false ): ?>

<?php endif; ?>

<?php
$show_searchform = get_theme_mod( 'store99_enable_search_form', true );
$show_minicart   = get_theme_mod( 'store99_enable_mini_cart', true );

if ( get_theme_mod( 'store99_enable_header_top' ) != false ):
	$email = get_theme_mod( 'store99_email' );
	$phone       = get_theme_mod( 'store99_phone' );
	$address     = get_theme_mod( 'store99_address' );
	?>

    <!-- header-top -->
    <div class="header-top">
        <div class="container clearfix">
			<?php if ( $email || $phone || $address ): ?>
                <div class="left">
                    <ul class="header-quicklinks">

						<?php if ( ! empty( $email ) ): ?>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <a href="<?php echo esc_url('mailto:'.$email); ?>"><?php echo esc_html( $email ); ?></a>
                            </li>
						<?php endif; ?>
						<?php if ( ! empty( $phone ) ): ?>
                            <li>
                                <i class="fa fa-phone"></i>
                                <a href="<?php echo esc_url('tel:'.$phone) ?>"><?php echo esc_html( $phone ); ?></a>
                            </li>
						<?php endif; ?>

						<?php if ( ! empty( $address ) ): ?>
                            <li>
                                <i class="fa fa-map-marker"></i>
								<?php echo esc_html( $address ); ?>
                            </li>
						<?php endif; ?>

                    </ul>
                </div>
			<?php endif; ?>
			<?php
			if ( has_nav_menu( 'top' ) ) :
				?>
                <div class="right">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'top',
						'container'      => false,
						'depth'          => 1
					) );
					?>
                </div>
				<?php
			endif;
			?>
        </div>
    </div>

	<?php
endif; ?>

<!-- middle-part -->
<div class="middle">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="site-branding">
					<?php if ( store99_has_logo() ) : ?>
                        <div id="site-logo">
							<?php store99_logo(); ?>
                        </div>
					<?php else: ?>
                        <div id="text-title-desc">
                            <h1 class="site-title">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo">
									<?php bloginfo( 'name' ); ?>
                                </a>
                            </h1>
                        </div>
					<?php endif; ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
				<?php if ( $show_searchform != false ): ?>
					<?php if ( store99_is_woocommerce_activated() ): ?>
                        <div class="advanced-search">
							<?php store99_product_search(); ?>
                        </div>
					<?php else: ?>
                        <div class="normal-search">
							<?php store99_normal_search(); ?>
                        </div>
					<?php endif; ?>
				<?php endif; ?>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 hidden-xs clearfix">
				<?php if ( store99_is_woocommerce_activated() ): ?>
					<?php if ( $show_minicart != false ): ?>
						<?php store99_cart_link(); ?>
                        <div class="cart-popup">
							<?php the_widget( 'WC_Widget_Cart', 'title=cart' ); ?>
                        </div>
					<?php endif; ?>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- navbar -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header <?php echo ! has_nav_menu( 'category' ) ? 'no-category-menu' : ''; ?>">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only"><?php echo esc_html__('Toggle navigation','store99'); ?></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<?php if ( has_nav_menu( 'category' ) ) : ?>
                <div id="dd" class="wrapper-dropdown-5">
                    <a href="javascript:void(0)">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                       <?php echo  esc_html__( 'CATEGORIES', 'store99'); ?>
                    </a>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'category',
						'container'      => false,
						'menu_class'     => 'dropdown',
						'depth'          => 2
					) );
					?>
                </div>
			<?php endif; ?>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav navbar-nav mainnav clearfix',
				'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
				'depth'          => 3,
				'walker'         => new WP_Bootstrap_Navwalker()
			) );
			?>
            <ul class="navbar-right">
				<?php
				if ( store99_is_woocommerce_activated() ) {
					if ( ! is_user_logged_in() ) {
						?>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>">
                                <i class="fa fa-user" aria-hidden="true"></i><?php echo esc_html__('LOGIN / REGISTER', 'store99'); ?>
                            </a>
                        </li>
						<?php

					} else { ?>
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"
                               aria-haspopup="true"
                               aria-expanded="false">
								<?php echo esc_attr( wp_get_current_user()->user_login ); ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo esc_url( home_url( '/my-account' ) ); ?>"><?php echo esc_html__('My Account','store99'); ?></a></li>
                                <li><a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>"><?php echo esc_url('logout','store99'); ?></a>
                                </li>
                            </ul>
                        </li>
						<?php
					}
				} ?>
            </ul>
        </div>
    </div>
</nav>