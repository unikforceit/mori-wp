<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mori
 */

$preloader = mori_theme_options('enb_pre');
$scrolltop = mori_theme_options('enb_scroll');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <?php if ($preloader){?>
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <?php mori_logo(); ?>
                </div>
            </div>
        </div>
    <?php } ?>
<?php if ($scrolltop){?>
    <!-- Scroll -->
    <div class="scroll-top">
        <i class="fas fa-arrow-up"></i>
    </div>
<?php } ?>
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'mori'); ?></a>
<?php
    get_template_part('template-parts/header/header', 'v1');
?>