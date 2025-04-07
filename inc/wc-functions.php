<?php
function mori_wishlist_icon_in_product_grid() {
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>
        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="valento_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? 'clicked added' : 'add_to_wishlist'; ?>" rel="nofollow" data-toggle="tooltip">
            <i class="ri-heart-line"> </i>
            <span class="mori-tooltip">
                <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_attr(get_option( 'yith_wcwl_browse_wishlist_text' )) : esc_attr(get_option('yith_wcwl_add_to_wishlist_text')); ?>
            </span>
            <span class="icon"><i><?php echo file_get_contents(get_template_directory_uri() . '/images/heart.svg') ?></i></span>
        </a>
    <?php
    endif;
}
function mori_wishlist_icon_in_single_prd() {
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>

        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="valento_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? 'clicked added' : 'add_to_wishlist'; ?>" rel="nofollow" data-toggle="tooltip">
            <i class="ri-heart-line"> </i>
            <span class="mori-tooltip">
                <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id())? esc_attr(get_option( 'yith_wcwl_browse_wishlist_text' )) : esc_attr(get_option('yith_wcwl_add_to_wishlist_text')); ?>
            </span>
            <span class="icon"><i><?php echo file_get_contents(get_template_directory_uri() . '/images/heart.svg') ?></i></span>
        </a>

    <?php
    endif;
}

add_filter('woocommerce_add_to_cart_fragments', 'mori_woocommerce_header_add_to_cart_fragment');

function mori_woocommerce_header_add_to_cart_fragment($fragments)
{
    global $woocommerce;
    ob_start();
    ?>
    <span class="mori-cart-count"><?php echo wp_kses_post($woocommerce->cart->cart_contents_count); ?></span>
    <?php
    $fragments['span.mori-cart-count'] = ob_get_clean();
    return $fragments;
}

/**
 * WooCommerce update mini cart on ajax click
 */
// Update Cart Count & Mini Cart
add_filter('woocommerce_add_to_cart_fragments', 'mori_cart_count_fragments', 10, 1);

function mori_cart_count_fragments($fragments)
{
    if (!empty(WC()->cart->get_cart_contents_count())) {
        $fragments['span.mori-cart-count'] = '<span class="mori-cart-count">(' . WC()->cart->get_cart_contents_count() . ')</span>';

        ob_start();
        echo '<div class="widget_shopping_cart_content">';
            woocommerce_mini_cart();
        echo '</div>';
        $fragments['div.widget_shopping_cart_content'] = ob_get_clean();
    }

    return $fragments;

}

//-----------------------------------------------------
// [1] Enqueue scripts and add localized parameters
//-----------------------------------------------------
add_action( 'wp_enqueue_scripts', 'mori_custom_scripts_enqueue' );
function mori_custom_scripts_enqueue() {

    $theme = wp_get_theme(); // Get the current theme version numbers for bumping scripts to load

    // Make sure jQuery is being enqueued, otherwise you will need to do this.

    // Register custom scripts
    wp_enqueue_script('mori_ajax', get_template_directory_uri() . '/assets/js/mori-ajax.js', array('jquery'), MORI_VERSION, true);
    // Register script with depenancies and version in the footer

    // Enqueue scripts
    wp_enqueue_script('mori_ajax');


    global $wp_query; // Make sure important query information is available

    // Use wp_localize_script to output some variables in the html of each WordPress page
    // These variables/parameters are accessible to the load_more.js file we enqueued above
    $localize_var_args = array(
        'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
        'ajaxurl' => admin_url( 'admin-ajax.php' )

    );
    wp_localize_script( 'mori_ajax', 'mori_ajax', $localize_var_args );

}


//-----------------------------------------------------
// [3] Load More Products with AJAX
//-----------------------------------------------------
add_action('wp_ajax_mori_loadmore_products', 'mori_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_mori_loadmore_products', 'mori_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
function mori_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    query_posts( $args );

    if( have_posts() ) :

        // run the loop
        while( have_posts() ): the_post();

            wc_get_template_part( 'content', 'product' );  // As we are loaded Woocommerce products we use wc_get_template_part

        endwhile;

    endif;
    die; // Exit the script, wp_reset_query() required!

}


//-----------------------------------------------------
// [4] Remove Woocommerce pagination as we do not need it any more
//-----------------------------------------------------
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );


//-----------------------------------------------------
// [5] Add in our load more products container and button
//-----------------------------------------------------
add_action( 'woocommerce_after_shop_loop', 'mori_woocommerce_products_load_more', 9 );
function mori_woocommerce_products_load_more(){
    global $wp_query;

    echo '<div id="container_products_more">';
    if (  $wp_query->max_num_pages > 1 ) {
        echo '<button id="mori_loadmore_products" class="product-cart-btn">LOAD MORE</button>';
    }
    echo '</div>';

}

// Add Mori Options Tab to WooCommerce Settings
function add_mori_options_tab( $sections ) {
    $sections['mori_options'] = __( 'Mori Options', 'woocommerce' );
    return $sections;
}
add_filter( 'woocommerce_get_sections_products', 'add_mori_options_tab' );

// Add Mori Options fields to the custom tab
function add_mori_options_fields( $settings, $current_section ) {
    if ( $current_section == 'mori_options' ) {
        $mori_settings = [];

        $mori_settings[] = array(
            'name' => __( 'Mori Options', 'woocommerce' ),
            'type' => 'title',
            'desc' => __( 'The following options are used to configure mori woocommerce', 'woocommerce' ),
            'id' => 'mori_options'
        );

        $mori_settings[] = array(
            'title'    => __( 'Product Per Page', 'woocommerce' ),
            'desc'     => __( 'Customize product display settings for Mori theme.', 'woocommerce' ),
            'id'       => 'mori_product_per_page',
            'default'  => 12,
            'type'     => 'number',
            'desc_tip' => true,
            'label'    => __( 'Products per page', 'woocommerce' ),
        );

        $mori_settings[] = array(
            'title'    => __( 'Products per Row', 'woocommerce' ),
            'desc'     => __( 'Number of products per row in product archive pages.', 'woocommerce' ),
            'id'       => 'mori_products_per_row',
            'default'  => 4,
            'type'     => 'number',
            'desc_tip' => true,
            'label'    => __( 'Products per Row', 'woocommerce' ),
        );

        // Register page selection
        $mori_settings[] = array(
            'title'    => __( 'Register Page', 'woocommerce' ),
            'desc'     => __( 'Select a page for the register page.', 'woocommerce' ),
            'id'       => 'mori_register_page',
            'default'  => '',
            'type'     => 'single_select_page',
            'desc_tip' => true,
        );
        $mori_settings[] = array( 'type' => 'sectionend', 'id' => 'mori_options' );
        return $mori_settings;
    } else {
        return $settings;
    }
}
add_filter( 'woocommerce_get_settings_products', 'add_mori_options_fields', 10, 2 );


// Modify the number of products per page
function mori_products_per_page( $cols ) {
    $products_per_page = get_option( 'mori_product_per_page', 12 ); // Default to 12 if not set
    return $products_per_page;
}
add_filter( 'loop_shop_per_page', 'mori_products_per_page', 20 );

// Modify the number of products per row
function mori_products_per_row( $columns ) {
    $products_per_row = get_option( 'mori_products_per_row', 4 ); // Default to 4 if not set
    return $products_per_row;
}
add_filter( 'woocommerce_loop_columns', 'mori_products_per_row', 20 );

// Check if current page is the register page and inject the registration form
function embed_registration_form_on_page( $content ) {
    // Get the custom register page ID from settings
    $register_page_id = get_option( 'mori_register_page' );

    // Check if we're on the correct page and the register page is selected
    if ( is_page( $register_page_id ) ) {
        // Ensure we're not logged in and it's the registration page
        if ( ! is_user_logged_in() ) {
            // Load the register form from the form-registration.php template
            ob_start();
            wc_get_template_part( 'myaccount/form-registration' ); // This loads the form-registration.php
            $content .= ob_get_clean(); // Append the registration form to the page content
        } else {
            // Optionally, redirect logged-in users or show a message
            $content .= '<p>' . esc_html__( 'You are already logged in.', 'woocommerce' ) . '</p>';
        }
    }
    return $content;
}
add_filter( 'the_content', 'embed_registration_form_on_page' );

// Redirect logged-in users to the account page
function redirect_logged_in_users_from_register_page() {
    if ( get_option( 'mori_register_page' ) && is_page( get_option( 'mori_register_page' ) ) && is_user_logged_in() ) {
        wp_redirect( wc_get_account_endpoint_url('') ); // Redirect to My Account page
        exit;
    }
}
add_action( 'template_redirect', 'redirect_logged_in_users_from_register_page' );

add_action( 'woocommerce_created_customer', 'save_custom_registration_fields' );

function save_custom_registration_fields( $customer_id ) {
    if ( isset( $_POST['first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( isset( $_POST['last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( isset( $_POST['company_name'] ) ) {
        update_user_meta( $customer_id, 'company_name', sanitize_text_field( $_POST['company_name'] ) );
    }
    if ( isset( $_POST['chamber_of_commerce'] ) ) {
        update_user_meta( $customer_id, 'chamber_of_commerce', sanitize_text_field( $_POST['chamber_of_commerce'] ) );
    }
    if ( isset( $_POST['vat_number'] ) ) {
        update_user_meta( $customer_id, 'vat_number', sanitize_text_field( $_POST['vat_number'] ) );
    }
    if ( isset( $_POST['phone'] ) ) {
        update_user_meta( $customer_id, 'phone', sanitize_text_field( $_POST['phone'] ) );
    }
}

/**
 * Add WooCommerce-specific body classes
 */
function add_woocommerce_body_classes($classes) {
    if (function_exists('is_woocommerce')) {
        // General WooCommerce pages
        if (is_woocommerce()) {
            $classes[] = 'mori-woocommerce-page';
        }

        // Shop page
        if (is_shop()) {
            $classes[] = 'mori-woocommerce-shop';
        }

        // Checkout page
        if (is_checkout()) {
            $classes[] = 'mori-woocommerce-checkout';
        }
        if(is_page( get_option( 'mori_register_page' ) )){
            $classes[] = 'mori-woocommerce-register';
        }

        // Account pages
        if (is_account_page()) {
            $classes[] = 'mori-woocommerce-account';
            if (is_wc_endpoint_url('orders')) {
                $classes[] = 'mori-woocommerce-account-orders';
            }
            if (is_wc_endpoint_url('view-order')) {
                $classes[] = 'mori-woocommerce-account-view-order';
            }
            if (is_wc_endpoint_url('downloads')) {
                $classes[] = 'mori-woocommerce-account-downloads';
            }
            if (is_wc_endpoint_url('edit-address')) {
                $classes[] = 'mori-woocommerce-account-edit-address';
            }
            if (is_wc_endpoint_url('payment-methods')) {
                $classes[] = 'mori-woocommerce-account-payment-methods';
            }
            if (is_wc_endpoint_url('edit-account')) {
                $classes[] = 'mori-woocommerce-account-edit-account';
            }
        }

        // Order received/thank you page
        if (is_order_received_page()) {
            $classes[] = 'mori-woocommerce-order-received';
        }
    }

    return $classes;
}
add_filter('body_class', 'add_woocommerce_body_classes');