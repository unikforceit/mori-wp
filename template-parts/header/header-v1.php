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
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="top-bar-icons">
                            <?php mori_svg_icons('star-fill');?>
                            <?php mori_svg_icons('star-fill');?>
                            <?php mori_svg_icons('star-fill');?>
                            <?php mori_svg_icons('star-fill');?>
                            <?php mori_svg_icons('star-leadinghalf-filled');?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="top-bar-text">
                            <p><?php mori_svg_icons('clock-arrow');?> <?php mori_translated_text('14 dagen bedenktijd');?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-header middle-header">
            <div class="container">
                <!-- Main Menu -->
                <div class="main-menu">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-2 col-md-2 col-sm-4 col mobile_menu_col">
                            <div class="mobile-bar-wrap">
                                <div class="mobile_menu_button open_mobile_menu">
                                    <div class="mobile-burger-menu">
                                        <span class="menu-line"></span>
                                        <span class="menu-line"></span>
                                        <span class="menu-line"></span>
                                    </div>
                                </div>
                                <div class="search-button">
                                    <a href="#" class="search-trigger"><?php mori_svg_icons('search');?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4 col desktop_logo_col">
                            <div class="logo d-logo">
                                <?php mori_logo(); ?>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-4 col-sm-4 col desktop_right_col">
                            <div class="middle-menu-right">
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
                                <div class="menu-right">
                                    <ul class="menu-right-list">
                                        <li class="language-drop">
                                            <select name="lang" id="lang">
                                                <option value="nl">
                                                    <span class="flag">🇳🇱</span> <span class="lang-name">NL</span>
                                                </option>
                                                <option value="en">
                                                    <span class="flag">🇬🇧</span> <span class="lang-name">EN</span>
                                                </option>
                                            </select>
                                        </li>
                                        <li class="user-link">
                                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount'));?>">
                                                <?php mori_svg_icons('user');?>
                                            </a>
                                        </li>
                                        <li class="heart-link">
                                            <a href="<?php echo esc_url(wc_get_page_permalink('myaccount'));?>">
                                                <?php mori_svg_icons('heart');?>
                                            </a>
                                        </li>
                                        <?php if (class_exists('WooCommerce')){?>
                                            <li><a class="cart-open" href="javascript:void(0)">
                                                    <?php mori_svg_icons('shopping-cart');?> <span class="mori-cart-count">0</span></a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
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
                            <span class="search-button"><?php mori_svg_icons('search');?></span>
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
                            <a class="thm-btn" href="#"><?php mori_svg_icons('graduation');?> <?php mori_translated_text('Trainingen');?></a>
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
                <div class="cart-close"><?php mori_svg_icons('close');?></div>
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
                    <?php mori_svg_icons('close');?>
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
        <button class="close-trigger"><?php mori_svg_icons('close');?></button>
    </div>
    <div class="inner">
        <form id="searchform" class="searchbox search-form" action="<?php echo home_url('/');?>"  method="get">
            <input type="text" id="search" placeholder="<?php mori_translated_text('Ik ben opzoek naar…');?>" class="input search-popup-field" name="s" value=""/>
            <input type="hidden" name="post_type" value="product" />
            <button class="search-button" type="submit"><?php mori_svg_icons('search');?> <?php mori_translated_text('Search');?></button>
        </form>
    </div>
</div>
<!-- End Search Popup  -->