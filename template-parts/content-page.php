<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="imgArea">
        <?php
        if (has_post_thumbnail() && is_singular() || has_post_thumbnail()) {
            $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            echo '<div class="blogImg" style="background: url(' . esc_url($featured_img[0]) . ') no-repeat center center; background-size: cover;">';
        }
        ?>
    </div>

    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'mori'),
                'after' => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
