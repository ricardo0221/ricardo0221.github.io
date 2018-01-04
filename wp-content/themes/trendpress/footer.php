<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendpress
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
    <?php if(is_active_sidebar('trendpress-footer-1') || is_active_sidebar('trendpress-footer-2') || is_active_sidebar('trendpress-footer-3')){ ?>
        <div class="bottom-footer wow fadeInUp">
            <div class="tp-container">
                <div class="bottom-footer-wrapper clearfix">
                    <?php if(is_active_sidebar('trendpress-footer-1')){
                        ?>
                            <div class="footer-1">
                                <?php dynamic_sidebar('trendpress-footer-1'); ?>
                            </div>
                        <?php
                    } ?>
                    <?php if(is_active_sidebar('trendpress-footer-2')){
                        ?>
                            <div class="footer-2">
                                <?php dynamic_sidebar('trendpress-footer-2'); ?>
                            </div>
                        <?php
                    } ?>
                    <?php if(is_active_sidebar('trendpress-footer-3')){
                        ?>
                            <div class="footer-3">
                                <?php dynamic_sidebar('trendpress-footer-3'); ?>
                            </div>
                        <?php
                    } ?>
                    <?php if(is_active_sidebar('trendpress-footer-4')){
                        ?>
                            <div class="footer-3">
                                <?php dynamic_sidebar('trendpress-footer-4'); ?>
                            </div>
                        <?php
                    } ?>                    
                </div>
            </div>
        </div>
    <?php } ?>
    
		<div class="site-info">
            <div class="tp-container">
                <?php $trendpress_footer_text = get_theme_mod('trendpress_footer_text'); ?>
    			<span class="footer-text"><?php if($trendpress_footer_text){ ?><span class="text-input"><?php echo esc_attr($trendpress_footer_text); ?><span class="sep"> | </span></span><?php } ?>  <?php esc_html_e('WordPress Theme','trendpress');?> :<?php esc_html_e(' Trendpress','trendpress'); ?><?php esc_html_e(' by','trendpress');?> <a target="_blank" href="<?php echo esc_url('http://themeruler.com/') ?>"><?php esc_html_e('Theme Ruler','trendpress');?></a></span>
            </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>