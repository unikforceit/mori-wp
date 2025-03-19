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
    <header id="main-header" class="main-header main-header-2">
        <div class="top-bar-area">
            <p>14 dagen bedenktijd</p>
        </div>
        <div class="menu-header">
            <div class="container-fluid">
                <!-- Main Menu -->
                <div class="main-menu">
                    <div class="row justify-content-between align-items-center">

                        <div class="col-lg-3 col-md-4 col-sm-8 logo-col">
                            <div class="logo">
                                <?php mori_logo(); ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 col-sm-4 menu-col">
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
                            <!-- Start Mobile Menu -->
                            <div class="mobile_menu position-relative">
                                <div class="mobile_menu_button open_mobile_menu">
                                    <i class="fas fa-bars"></i>
                                </div>
                                <div class="mobile_menu_wrap">
                                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                                    <div class="mobile_menu_content">
                                        <div class="mobile_menu_close open_mobile_menu">
                                            <i class="fas fa-times"></i>
                                        </div>
                                        <div class="m-brand-logo">
                                            <?php mori_logo(); ?>
                                        </div>
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
                            <!-- End Mobile Menu -->
                        </div>
                        <div class="col-lg-3 display-none">
                            <div class="menu-right">
                                <ul>
                                    <li class="dropdown"><a href="javascript:void(0)"><i><img
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
                                    <?php if (class_exists('YITH_WCWL')){?>
                                        <li><a href="<?php echo YITH_WCWL()->get_wishlist_url();?>"><i><img
                                                            src="<?php echo get_template_directory_uri(); ?>/images/heart.svg"></i><span class="yith-wcwl-items-count">
                                                    <?php echo yith_wcwl_count_all_products();?>
                                                </span></a>
                                        </li>
                                    <?php } ?>
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
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-5">
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
                <!-- Start Mobile Menu -->
                <div class="mobile_menu position-relative">
                    <div class="mobile_menu_button open_mobile_menu">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="mobile_menu_wrap">
                        <div class="mobile_menu_overlay open_mobile_menu"></div>
                        <div class="mobile_menu_content">
                            <div class="mobile_menu_close open_mobile_menu">
                                <i class="fas fa-times"></i>
                            </div>
                            <div class="m-brand-logo">
                                <?php mori_logo(); ?>
                            </div>
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
                <!-- End Mobile Menu -->
                </div>
                <div class="col-lg-4">
                <div class="search-wrapper">
                    <div class="inner">
                        <form id="searchform" class="searchbox search-form" action="<?php echo home_url('/');?>"  method="get">
                            <input type="text" id="search" placeholder="Search Here..." class="input search-popup-field" name="s" value=""/>
                            <input type="hidden" name="post_type" value="product" />
                            <button class="submit-button"><i><img
                                            src="<?php echo get_template_directory_uri(); ?>/images/search.svg"></i></button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-3">
                    <div class="header-right-buttons">
                        <div class="mori-button">
                            <a class="thm-btn" href="#">Webshop</a>
                        </div>
                        <div class="mori-button-outline">
                            <a class="thm-btn" href="#">Trainingen</a>
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