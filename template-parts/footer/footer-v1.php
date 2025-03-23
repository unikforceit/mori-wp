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
    <div class="footer-widget-area">
        <div class="container">
            <div class="footer-widgets-wrapper">
                <?php if ( is_active_sidebar( 'footer' ) ) : ?>
                    <div class="row">
                        <?php dynamic_sidebar( 'footer' ); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-middle-area">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="footer-logo">
                            <img src="<?php echo get_template_directory_uri() . '/images/logo-white.png';?>" alt="Footer Logo">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="footer-middle-menu-area">
                            <nav class="footer-middle-menu ul-li">
                                <?php
                                echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                                    wp_nav_menu(array(
                                            'container' => false,
                                            'echo' => false,
                                            'menu_id' => 'footer-nav',
                                            'theme_location' => 'footer',
                                            'fallback_cb' => 'mori_no_footer_nav',
                                            'items_wrap' => '<ul>%3$s</ul>',
                                        )
                                    ));
                                ?>
                            </nav>
                            <div class="footer-middle-social ul-li">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-shape">
            <img src="<?php echo get_template_directory_uri() . '/images/footer-shape.png';?>" alt="Payment Icon">
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-md-6">
                    <div class="payment-icons">
                        <img src="<?php echo get_template_directory_uri() . '/images/payment-icon.png';?>" alt="Payment Icon">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="copyright-menu">
                        <nav class="copyright-main-area ul-li">
                            <?php
                            echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                                wp_nav_menu(array(
                                        'container' => false,
                                        'echo' => false,
                                        'menu_id' => 'copyright-nav',
                                        'theme_location' => 'copyright',
                                        'fallback_cb' => 'mori_no_copyright_nav',
                                        'items_wrap' => '<ul>%3$s</ul>',
                                    )
                                ));
                            ?>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!-- .site-info -->
    </div>
</footer><!-- #footerSection -->
