<?php
if (!class_exists('Mori_Woo_init')) {
    final class Mori_Woo_init
    {
        /**
         * $instance
         * @since 1.0.0
         */
        protected static $instance;

        public function __construct()
        {
//            Filter
            add_filter('loop_shop_per_page', [$this, 'shop_per_page'], 30);

//            Remove action
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
            remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
            remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);


//            Add  Action
            add_action('after_setup_theme', [$this, 'woo_setup']);
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'loop_thumb_start'], 9);
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'loop_thumb_end'], 11);
            add_action('woocommerce_before_shop_loop_item', [$this, 'loop_wrap_start'], 9);
            add_action('woocommerce_after_shop_loop_item', [$this, 'loop_wrap_end'], 11);
            add_action('woocommerce_shop_loop_item_title', [$this, 'woo_title_wrap_start'], 9);
            add_action('woocommerce_after_shop_loop_item_title', [$this, 'woo_title_wrap_end'], 11);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9);
            add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);
            // Product per page
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);
            add_action('woocommerce_before_quantity_input_field', [$this, 'mori_qty_before'], 10);
            add_action('woocommerce_after_quantity_input_field', [$this, 'mori_qty_after'], 10);
            add_action('woocommerce_before_shop_loop', [$this, 'mori_shop_title_before'], 21);
            add_action('woocommerce_show_page_title', [$this, 'mori_shop_header_before']);
            add_action('woocommerce_before_shop_loop', [$this, 'mori_shop_header_after'], 31);
            add_action( 'woocommerce_before_single_product_summary', [$this, 'main_image_with_slider'], 20 );
            add_action( 'woocommerce_single_product_summary', [$this, 'add_buy_now_button'], 30 );
            add_action( 'woocommerce_after_add_to_cart_button', [$this, 'add_yith_wishlist_button'], 10 );
            add_filter( 'woocommerce_product_related_products_heading', [$this, 'change_related_heading'] );

        }

        /**
         * getInstance()
         */
        public static function getInstance()
        {

            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function woo_setup()
        {
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
        }

        public function loop_thumb_start()
        {
            ?>
            <div class="product-thumb">
            <?php
        }

        public function loop_thumb_end()
        {
            ?>
            <div class="overlay-box">
                <div class="product-action">
                    <?php
                    if (class_exists('YITH_WCQV')) :
                        ?>
                        <a href="#" class="yith-wcqv-button" data-product_id="<?php the_ID(); ?>">
                            <span class="action-text"></span>
                            <span class="icon"><i><?php echo file_get_contents(get_template_directory_uri() . '/images/eye.svg') ?></i></span>
                        </a>
                    <?php
                    endif;
                    ?>
                    <?php mori_wishlist_icon_in_product_grid(); ?>
                </div>
                <div class="product-cart">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
            </div>
            </div>
            <?php
        }

        public function loop_wrap_start()
        {
            ?>
            <div class="product-card-item">
            <?php
        }

        public function loop_wrap_end()
        {
            ?>
            </div>
            <?php
        }

        public function woo_title_wrap_start()
        {
            ?>
            <div class="card-description">
            <?php
        }

        public function woo_title_wrap_end()
        {
            ?>
            </div>
            <?php
        }


        // Product per pages filters
        public function shop_per_page($product)
        {
            $product = 12;
            return $product;
        }

        public function mori_qty_before()
        {
            ?>
            <button type="button" class="minus">-</button>
            <?php
        }

        public function mori_qty_after()
        {
            ?>
            <button type="button" class="plus">+</button>
            <?php
        }

        public function mori_shop_header_before()
        {
            ?>
            <div class="mori-shop-header">
                <div class="mori-title-shop">
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php
        }

        public function mori_shop_title_before()
        {
            ?>
            </div>
            <?php
        }
        public function mori_shop_header_after()
        {
            ?>
            </div>
            <?php
        }
        public function main_image_with_slider() {
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();
            if (!empty($attachment_ids)){
            ?>
            <div class="product-images-slider-area">
                <div class="swiper product-image-slider">
                    <div class="swiper-wrapper">
                        <?php
                        echo '<div class="swiper-slide">';
                            echo woocommerce_get_product_thumbnail('full');
                        echo '</div>';
                        foreach ( $attachment_ids as $attachment_id ) {
                            echo '<div class="swiper-slide">';
                            echo wp_get_attachment_image( $attachment_id, 'full' );
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <?php
            } else { ?>
                <div class="product-images-area">
                    <?php echo woocommerce_get_product_thumbnail('full')?>
                </div>
            <?php
            }
        }
        public function add_yith_wishlist_button() {
            if( function_exists( 'YITH_WCWL' ) ){
                mori_wishlist_icon_in_single_prd();
            }
        }
        public function add_buy_now_button() {
            global $product;
            echo '<a type="submit" class="buy-now-button" href="'.esc_url( $product->add_to_cart_url() ).'&checkout=1">Buy Now</a>';
        }
        public function change_related_heading() {
            $args = 'You may also like';
            return $args;
        }
    }

    if (class_exists('Mori_Woo_init')) {
        Mori_Woo_init::getInstance();
    }
}