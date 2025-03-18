<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

get_header();
?>
    <main id="primary" class="container">
        <div class="row">
            <?php
            if (have_posts()) {

                /* Start the Loop */
                while (have_posts()) {
                    the_post();

                    /*
                    * Include the Post-Type-specific template for the content.
                    * If you want to override this in a child theme, then include a file
                    * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                    */
                    get_template_part('template-parts/content', get_post_type());
                }

            } else {

                get_template_part('template-parts/content', 'none');

            }
            ?>
        </div>
        <nav class="mori-pagination" aria-label="Page navigation">
            <?php mori_pagination();?>
        </nav>
    </main><!-- #main -->
<?php
get_footer();
