<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$register_page_id = get_option( 'mori_register_page' );
do_action( 'woocommerce_before_customer_login_form' );
?>
<div class="row">
    <div class="col-lg-6">
        <div class="login-left-wrapper">
            <div class="login-sec-title">
                <p><?php mori_translated_text('Inloggen bij Mori');?></p>
                <h2><?php mori_translated_text('Jouw ambities, jouw start, jouw moment!');?></h2>
            </div>
            <div class="login-author">
                <div class="login-author-img">
                    <img src="<?php echo get_template_directory_uri() . '/images/contact.png';?>" alt="Author Title">
                </div>
                <div class="login-author-title">
                    <p><?php mori_translated_text('Contact');?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="login-form-wrapper">
            <form class="woocommerce-form woocommerce-form-login login" method="post" novalidate>
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" required aria-required="true" />
                </p>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                    <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <p class="form-row">
                    <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Inloggen', 'woocommerce' ); ?></button>
                    <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="thm-btn"><?php esc_html_e( 'Hulp bij inloggen', 'woocommerce' ); ?></a>
                </p>

                <div class="form-register-link">
                    <a href="<?php echo esc_url( get_permalink($register_page_id) ); ?>"><?php esc_html_e( 'Registreren als zakelijke partner', 'woocommerce' ); ?></a>
                </div>

                <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
            <?php mori_logo(); ?>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
