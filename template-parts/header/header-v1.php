<?php
/**
 * The header for our theme home page
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mori
 */

?>
    <!-- Start Main Header -->
    <header id="main-header" class="main-header">
        <div class="top-bar-area">
            <p><?php mori_translated_text('14 dagen bedenktijd');?></p>
        </div>
        <div class="menu-header middle-header">
            <div class="container">
                <!-- Main Menu -->
                <div class="main-menu">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-2 col-md-2 col-sm-4 col mobile_menu_col">
                            <div class="mobile-bar-wrap">
                                <div class="mobile_menu_button open_mobile_menu">
                                    <i class="fa-solid fa-bars"></i>
                                </div>
                                <div class="search-button">
                                    <a href="#" class="search-trigger"><i class="fa-solid fa-magnifying-glass"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm- col">
                            <div class="logo d-logo">
                                <?php mori_logo(); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-4 col-sm-2 desktop_menu_col">
                            <!--Main Menu-->
                            <div class="main-menu-navigation">
                                <nav class="navigation-main-area ul-li">
                                    <?php
                                    echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                                        wp_nav_menu(array(
                                                'container' => false,
                                                'echo' => false,
                                                'menu_id' => 'main-nav',
                                                'theme_location' => 'primary',
                                                'fallback_cb' => 'mori_no_main_nav',
                                                'items_wrap' => '<ul>%3$s</ul>',
                                            )
                                        ));
                                    ?>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-2 col-sm-4 col">
                            <div class="menu-right">
                                <ul>
                                    <li class="dropdown"><a href="<?php echo esc_url(wc_get_page_permalink('myaccount'));?>"><i><img
                                                        src="<?php echo get_template_directory_uri(); ?>/images/user.svg"></i></a>
                                        <?php
                                        wp_nav_menu(array(
                                                'container' => false,
                                                'menu_id' => 'account-main-nav',
                                                'theme_location' => 'account',
                                                'fallback_cb' => 'mori_no_account_nav',
                                                'items_wrap' => '<ul class="dropdown-menu">%3$s</ul>',
                                                'depth' => 1,
                                            )
                                        );
                                        ?>
                                    </li>
                                    <?php if (class_exists('WooCommerce')){?>
                                        <li><a class="cart-open" href="javascript:void(0)"><i><img
                                                            src="<?php echo get_template_directory_uri(); ?>/images/shopping-bag.svg"></i><span class="mori-cart-count">0</span></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-bar-area">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                <!--Main Menu-->
                <div class="main-menu-navigation">
                    <nav class="navigation-main-area ul-li">
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                            wp_nav_menu(array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'shop-nav',
                                    'theme_location' => 'shop',
                                    'fallback_cb' => 'mori_no_shop_nav',
                                    'items_wrap' => '<ul>%3$s</ul>',
                                )
                            ));
                        ?>
                    </nav>
                </div>
                </div>
                <div class="col-lg-3">
                <div class="search-wrapper">
                    <div class="inner">
                        <form id="searchform" class="searchbox search-form" action="<?php echo home_url('/');?>"  method="get">
                            <input type="text" id="search" placeholder="<?php mori_translated_text('Ik ben opzoek naar…');?>" class="input search-popup-field" name="s" value=""/>
                            <input type="hidden" name="post_type" value="product" />
                            <span class="search-button"><i class="fa-solid fa-magnifying-glass"></i></span>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-3">
                    <div class="header-right-buttons">
                        <div class="mori-button">
                            <a class="thm-btn" href="#"><?php mori_translated_text('Webshop');?></a>
                        </div>
                        <div class="mori-button-outline">
                            <a class="thm-btn" href="#"><?php mori_translated_text('Trainingen');?></a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </header>
    <!-- End Main Header -->
    <div class="cart-overlay"></div>
    <div class="shop-cart">
        <div class="cart-wraper">
            <div class="cart-header">
                <div class="cart-close"><i class="fas fa-times"></i></div>
                <p>Cart</p>
            </div>
            <div class="widget_shopping_cart_content">
                <?php if (class_exists('WooCommerce')){?>
                    <?php woocommerce_mini_cart();?>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Start Mobile Menu -->
    <div class="mobile_menu position-relative">
        <div class="mobile_menu_wrap">
            <div class="mobile_menu_overlay open_mobile_menu"></div>
            <div class="mobile_menu_content">
                <div class="mobile_menu_close open_mobile_menu">
                    <i class="fas fa-times"></i>
                </div>
                <div class="m-brand-logo">
                    <?php mori_logo(); ?>
                </div>
                <div class="header-right-buttons">
                    <div class="mori-button">
                        <a class="thm-btn" href="#"><?php mori_translated_text('Webshop');?></a>
                    </div>
                    <div class="mori-button-outline">
                        <a class="thm-btn" href="#"><?php mori_translated_text('Trainingen');?></a>
                    </div>
                </div>
                <div class="m-main-menu">
                    <nav class="mobile-main-navigation  clearfix ul-li">
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                            wp_nav_menu(array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'm-shop-nav',
                                    'theme_location' => 'shop',
                                    'fallback_cb' => 'mori_no_shop_nav',
                                    'items_wrap' => '<ul class="navbar-nav text-capitalize clearfix">%3$s</ul>',
                                )
                            ));
                        ?>
                    </nav>
                </div>
                <div class="m-shop-menu">
                    <nav class="mobile-main-navigation  clearfix ul-li">
                        <?php
                        echo str_replace(['menu-item-has-children', 'sub-menu'], ['dropdown', 'dropdown-menu clearfix'],
                            wp_nav_menu(array(
                                    'container' => false,
                                    'echo' => false,
                                    'menu_id' => 'm-main-nav',
                                    'theme_location' => 'primary',
                                    'fallback_cb' => 'mori_no_main_nav',
                                    'items_wrap' => '<ul class="navbar-nav text-capitalize clearfix">%3$s</ul>',
                                )
                            ));
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- End Mobile Menu -->
<!-- Start Search Popup  -->
<div class="search-popup">
    <div class="close-button">
        <button class="close-trigger"><i class="fa-solid fa-times"></i></button>
    </div>
    <div class="inner">
        <form id="searchform" class="searchbox search-form" action="<?php echo home_url('/');?>"  method="get">
            <input type="text" id="search" placeholder="<?php mori_translated_text('Ik ben opzoek naar…');?>" class="input search-popup-field" name="s" value=""/>
            <input type="hidden" name="post_type" value="product" />
            <button class="search-button" type="submit"><i class="fa-solid fa-magnifying-glass"></i> <?php mori_translated_text('Search');?></button>
        </form>
    </div>
</div>
<!-- End Search Popup  -->