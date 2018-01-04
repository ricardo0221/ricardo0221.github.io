<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Store_99
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">

        <?php if (has_post_thumbnail()) { ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('store99-post-single', array('class' => 'img-responsive')); ?>
            </div>
        <?php } ?>

        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'store99'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->