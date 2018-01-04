<?php
if ( get_theme_mod( 'store99_main_slider_enable' ) ):
	$count =absint( get_theme_mod( 'store99_main_slider_count' )) ;
	for ( $i = 0; $i < $count; $i ++ ) {
		?>
        <div id="bootstrap-touch-slider" class="carousel bs-slider slide  control-round indicators-line"
             data-ride="carousel"
             data-pause="hover" data-interval="5000">

            <div class="carousel-inner" role="listbox">
				<?php
				for ( $i = 1; $i <= $count; $i ++ ) :

					$img = esc_url( get_theme_mod( 'store99_slide_img' . $i ) );
					$title = esc_html( get_theme_mod( 'store99_slide_title' . $i ) );
					$desc = esc_html( get_theme_mod( 'store99_slide_desc' . $i ) );
					$btn_text = esc_html( get_theme_mod( 'store99_slide_button_text' . $i ) );
					$btn_link = esc_url( get_theme_mod( 'store99_slide_button_link' . $i ) );
					if ( ! empty( $img ) ):
						?>
                        <div class="item <?php echo $i == 1 ? 'active' : ''; ?>">
                            <img src="<?php echo esc_url( $img ) ?>" data-thumb="<?php echo esc_url( $img ) ?>"
                                 class="img-responsive"
                                 title="<?php echo esc_attr( $title ) . " - " . esc_attr( $desc ) ?>"/>
                            <div class="bs-slider-overlay"></div>

                            <div class="container">
                                <div class="row">
                                    <!-- Slide Text Layer -->
                                    <div class="slide-text slide_style_center">
										<?php if ( $title ) : ?>
                                            <p data-animation="animated zoomInRight"><?php echo esc_attr( $title ); ?></p>
											<?php
										endif; ?>
										<?php
										if ( ! empty( $desc ) ): ?>
                                            <h1 data-animation="animated fadeInLeft">
												<?php echo esc_attr( $desc ); ?>
                                            </h1>
											<?php
										endif; ?>
										<?php
										if ( ! empty( $btn_text ) ): ?>
                                            <br>
                                            <a href="<?php echo ! empty( $btn_link ) ? esc_url( $btn_link ) : '#'; ?>"
                                               class="shop" data-animation="animated fadeInDown"
                                               style="margin-top: 27px;">
												<?php echo esc_attr( $btn_text ); ?>
                                            </a>
											<?php
										endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						<?php
					endif;
				endfor; ?>
            </div>

			<?php if ( $count > 1 ): ?>
                <!-- Left Control -->
                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo esc_html__('Previous', 'store99'); ?></span>
                </a>
                <!-- Right Control -->
                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                    <span class="sr-only"><?php echo esc_html__('Next', 'store99'); ?></span>
                </a>
			<?php endif; ?>
        </div>
		<?php
	}
endif;