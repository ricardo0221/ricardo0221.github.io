<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Store_99
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('store99-single-post'); ?>>
    <div class="blog-contro">
        <?php
        if (has_post_thumbnail()) {
            $image = get_the_post_thumbnail_url(get_the_ID(), 'store99-post-single');
            ?>
            <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive">

        <?php } ?>

        <h4><?php the_title(); ?></h4>

        <ul class="blog-meta">
            <li>
                <i class="fa fa-user"></i>
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
            </li>
            <li><i class="fa fa-clock-o"></i><?php the_date(); ?></li>
            <li><i class="fa fa-folder"></i><?php the_category(', '); ?></li>
            <li><i class="fa fa-tags"></i><?php the_tags(''); ?></li>
            <li><i class="fa fa-comment"></i><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></li>
        </ul>

        <div class="entry-content">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'store99'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->
    </div>
</article><!-- #post-## -->
