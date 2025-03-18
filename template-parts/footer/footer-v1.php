<?php
/**
 * The template for displaying the footer home
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mori
 */

?>
<footer id="footerSection" class="site-footer">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-4 col-md-6">
                <p class="copyright">
                    <span><?php bloginfo('name'); ?></span> <span>&copy;&nbsp;</span><span
                            class="copyright-year"><?php echo esc_html(date_i18n(_x('Y', 'copyright date format', 'mori'))); ?></span>
                    <span class="sep"> | </span>
                    <?php
                    esc_html_e('All rights reserved Webrito', 'mori');
                    ?>
                </p>
            </div>
            <div class="col-lg-4 col-md-6">
                <p class="copyright">
                    <a href="<?php echo esc_url(__('https://wordpress.org/', 'mori')); ?>">
                        <?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf(esc_html__('Proudly powered by %s', 'mori'), 'WordPress');
                        ?>
                    </a>. <?php esc_html_e('Theme by Webrito', 'mori'); ?>

                </p>
            </div>
        </div>
    </div><!-- .site-info -->
</footer><!-- #footerSection -->
