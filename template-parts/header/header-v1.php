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
                <div class="col-lg-6">
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
                <div class="col-lg-6">
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

    <!-- right side nav start  -->
    <div class="right-overlaly"></div>
    <div class="right-side-nav">
        <div class="nav-wraper">
            <div class="sidemenu-wrapper">
                <div class="sidemenu-icon">
                    <ul>
                        <li><a href="#" class="nav-close-btn"><i><img src="assets/img/icon/remove.png" alt=""></i></a>
                        </li>
                        <li><a href="#"><i><img src="./assets/img/icon/nav.png" alt=""></i></a></li>
                        <li><a class="cart-open" href="#"><i><img src="./assets/img/icon/shopping-bag-white.png"
                                                                  alt=""></i><span>01</span></a>
                        </li>
                        <li><a href="wishlist.html"><i><img src="./assets/img/icon/heart-white.png"
                                                            alt=""></i><span>01</span></a>
                        </li>
                        <li class="active"><a href="my-account.html"><i><img src="./assets/img/icon/user-white.png"
                                                                             alt=""></i></a>
                        </li>
                        <li><a href="wishlist.html"><i><img src="./assets/img/icon/call.png"></i></a></li>
                    </ul>
                    <div class="follow-us">
                        <ul>
                            <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="sidemenu-content">
                    <h3>Login In</h3>
                    <div class="side-line"></div>
                    <div class="side-button">
                        <a href="#" class="login-btn"><i><img src="assets/img/icon/google.png" alt=""></i>Login with
                            Google</a>
                        <a href="#" class="active login-btn"><i><img src="assets/img/icon/fackbook.png" alt=""></i>Login
                            with Facebook</a>
                    </div>
                    <form>
                        <div class="input-group">
                            <input type="text" placeholder="Email Address *">
                        </div>
                        <div class="input-group">
                            <input type="password" placeholder="Enter Password *">
                            <span><i class="fa fa-eye-slash"></i></span>
                        </div>
                    </form>
                    <div class="side-button">
                        <a href="#" class="login-btn"><i></i>Login In</a>
                        <a href="#" class="login-btn"><i></i>Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- right side nav  end-->

    <!-- Modal start -->
    <div class="modal modal-section fade" id="myModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-wraper">
                        <div class="modal-thumb">
                            <img src="assets/img/other/modal.png" alt="">
                        </div>
                        <div class="modal-content-wrapper">
                            <div class="content-wraper">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                <div class="news-letter-form">
                                    <h3>Our Newsletter</h3>
                                </div>
                                <p>Subscribe to the Mori Store get notified about exclusive offers every week! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal start end-->