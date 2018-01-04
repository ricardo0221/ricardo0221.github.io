<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Store_99
 */

get_header(); ?>

<?php do_action('store99-breadcrumb'); ?>

    <div id="primary" class="content-area">

        <div class="main-content-wrap">
            <div class="container">

                <div class="row main-content">

                    <?php
                    while (have_posts()) : the_post();

                        if (store99_is_woocommerce_page() == true)
                            echo '<div class="col-md-12">';
                        else
                            echo '<div class="col-md-9 col-left">';

                        get_template_part('template-parts/content', 'page');

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.

                    echo '</div>';

                    if (store99_is_woocommerce_page() == false)
                        get_sidebar();
                    ?>
                </div>
            </div>
        </div>

    </div><!-- #primary -->

<?php
get_footer();
