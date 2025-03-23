<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

get_header();
?>

    <!-- Start Blog Content -->
    <main class="blog-content section-gap">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="blog-posts">
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
                    </div>
                    <div class="pegination ul-li">
                        <?php mori_pagination(); ?>
                    </div>
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4 wow animate__fadeInUp" data-wow-duration="2s">
                    <?php get_sidebar('sidebar-1'); ?>
                </div>
            </div>
    </main>
<?php
get_footer();
