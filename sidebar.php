<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mori
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="blog-sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->
