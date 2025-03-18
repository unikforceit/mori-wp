<?php
/**
 * Mori functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mori
 */

if (!defined('MORI_VERSION')) {
    // Replace the version number of the theme on each release.
    define('MORI_VERSION', '1.0.0');
}

if (!function_exists('mori_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function mori_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on mori, use a find and replace
         * to change 'mori' to the name of your theme in all the template files.
         */
        load_theme_textdomain('mori', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        //woocommerce support
        //add_theme_support('woocommerce');


        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary', 'mori'),
                'account' => esc_html__('Account', 'mori'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'mori_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 90,
                'width' => 90,
                'flex-width' => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'mori_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mori_content_width()
{
    $GLOBALS['content_width'] = apply_filters('mori_content_width', 640);
}

add_action('after_setup_theme', 'mori_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mori_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'mori'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'mori'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="widget-head">
                                <h3>',
            'after_title' => '</h3></div>',
        )
    );


}

add_action('widgets_init', 'mori_widgets_init');
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function mori_fonts_url() {
    $fonts_url = '';
    $fonts = array();
    $subsets = 'latin'; // You can add other subsets like 'latin-ext' if needed.

    // Check if 'Poppins' is enabled
    if ('off' !== esc_html_x('on', 'Poppins font: on or off', 'mori')) {
        $fonts[] = 'Poppins:400,500,600,700,900';
    }

    // If we have fonts to load, build the URL
    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}


/**
 * Enqueue scripts and styles.
 */
function mori_scripts()
{
    wp_enqueue_style('mori-fonts', mori_fonts_url());
    wp_enqueue_style('mori-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-fontawesome', get_template_directory_uri() . '/assets/css/all.min.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-animate', get_template_directory_uri() . '/assets/css/animate.min.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-nice-select', get_template_directory_uri() . '/assets/css/nice-select.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-main', get_template_directory_uri() . '/assets/scss/mori.css', array(), mori_dynamic_version(), 'all');
    wp_enqueue_style('mori-style', get_stylesheet_uri(), array(), mori_dynamic_version());
    //wp_style_add_data('mori-style', 'rtl', 'replace');

    wp_enqueue_script('mori-appear-2', get_template_directory_uri() . '/assets/js/appear-2.js', array('jquery'), mori_dynamic_version(), true);
    wp_enqueue_script('mori-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), mori_dynamic_version(), true);
    wp_enqueue_script('mori-jquery-nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), MORI_VERSION, true);
    wp_enqueue_script('mori-swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), mori_dynamic_version(), true);
    wp_enqueue_script('mori-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), mori_dynamic_version(), true);
    wp_enqueue_script('mori-woo', get_template_directory_uri() . '/assets/js/mori-woo.js', array('jquery'), mori_dynamic_version(), true);

    wp_enqueue_script('mori-main', get_template_directory_uri() . '/assets/js/mori.js', array('jquery'), mori_dynamic_version(), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'mori_scripts');

function mori_admin_css() {
    wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/assets/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'mori_admin_css' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mori_customize_preview_js()
{
    wp_enqueue_script('mori-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), null, true);
}

add_action('customize_preview_init', 'mori_customize_preview_js');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Custom comment walker.
require get_template_directory() . '/inc/class-walker-comment.php';

require get_template_directory() . '/inc/plugins.php';

if (class_exists('WooCommerce')){
    require get_template_directory() . '/inc/wc-functions.php';
    require get_template_directory() . '/inc/woocommerce-hooks.php';
}