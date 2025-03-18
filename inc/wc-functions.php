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