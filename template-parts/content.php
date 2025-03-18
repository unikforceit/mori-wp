<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mori
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('col-lg-6'); ?>>
    <div class="blog-post-item d-flex flex-column">
        <?php
            if (has_post_thumbnail()) { ?>
                <div class="thumbImg">
                    <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>
                </div>
        <?php } ?>
        <div class="content">
            <div class="post-dca">
                <ul>
                    <li><a href="#"> <?php the_date('M j, Y'); ?></a></li>
                </ul>
            </div>
            <a class="title" href="<?php the_permalink();?>"><?php the_title();?></a>
            <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12, '');?></p>
            <a href="<?php the_permalink();?>" class="permaLink"><?php esc_html_e('Read More', 'mori');?></a>
        </div>
    </div>
</div>
