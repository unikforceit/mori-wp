<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

get_header();
?>

    <section class="blog-content section-gap">
        <div class="container">
            <?php if ( have_posts() ) :

                woocommerce_content();

            endif; // End of the loop.
            ?>
        </div>
    </section><!-- #main -->

<?php
get_footer();
