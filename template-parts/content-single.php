<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-left wow animate__fadeInUp'); ?>
     data-wow-duration="1.5s">
    <?php
    if (has_post_thumbnail()) { ?>
        <div class="blog-img">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php } ?>
    <!-- Post date - Comment - Author -->
    <div class="post-dca ul-li">
        <ul>
            <li><?php the_date('M j, Y'); ?></li>
            <li><?php esc_html_e(get_comments_number().' Comments'); ?></li>
            <li><?php echo esc_html('by'); ?> <?php the_author(); ?></li>
        </ul>
    </div>
    <!-- Post Content -->
    <div class="blog-post-content">
        <?php the_content(); ?>
    </div>
    <!-- Tag & Share -->
    <div class="blog-tagShare ul-li d-flex justify-content-between align-items-center flex-wrap">
        <div class="blog-tag d-flex">
            <h3><?php echo esc_html('Tags:'); ?></h3>
            <?php mori_post_tag(); ?>
        </div>
        <div class="blog-social-share">
            <h5><?php echo esc_html('Share:'); ?></h5>
            <?php mori_post_share(); ?>
        </div>
    </div>
    <!-- Previous & Next Post -->
    <?php mori_next_pre_post();?>
    <!-- Related Post -->
    <?php mori_related_post();?>
</div>