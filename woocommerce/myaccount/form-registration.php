<?php
/**
 * Custom Register Form Template
 *
 * @package WooCommerce/Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_register_form' );
?>
<div class="woocommerce">
    <div class="row">
        <div class="col-lg-5">
            <div class="login-left-wrapper">
                <div class="login-sec-title">
                    <p><?php mori_translated_text('Inloggen bij Mori');?></p>
                    <h2><?php mori_translated_text('Join the Vision.');?></h2>
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
        <div class="col-lg-7">
            <div class="register-form-wrapper">
                <form method="post" class="woocommerce-form woocommerce-form-register register">
                    <?php do_action( 'woocommerce_register_form_start' ); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <?php mori_translated_text('Om toegang te krijgen tot onze B2B bestelsite met prijzen, laat uw gegevens achter en we nemen spoedig contact op.');?>
                    </p>
                    <div class="row">
                    <div class="col-lg-6">
                    <!-- First Name Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_first_name"><?php esc_html_e( 'Voornaam', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="first_name" id="reg_first_name" autocomplete="given-name" required aria-required="true" />
                    </p>
                    </div>
                    <div class="col-lg-6">
                    <!-- Last Name Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_last_name"><?php esc_html_e( 'Achternaam', 'woocommerce' ); ?></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="last_name" id="reg_last_name" autocomplete="family-name" required aria-required="true" />
                    </p>
                    </div>
                    </div>
                    <!-- Company Name Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_company_name"><?php esc_html_e( 'Bedrijfsnaam / Organisatie', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="company_name" id="reg_company_name" autocomplete="organization" required aria-required="true" />
                    </p>

                    <!-- Chamber of Commerce Number Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_chamber_of_commerce"><?php esc_html_e( 'KvK-nummer Vereist', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="chamber_of_commerce" id="reg_chamber_of_commerce" required aria-required="true" />
                    </p>

                    <!-- VAT Number Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_vat_number"><?php esc_html_e( 'BTW nummer Vereist', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="vat_number" id="reg_vat_number" required aria-required="true" />
                    </p>

                    <!-- Email Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email"><?php esc_html_e( 'E-mailadres Vereist', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" required aria-required="true" />
                    </p>

                    <!-- Phone Number Field -->
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_phone"><?php esc_html_e( 'Telefoon', 'woocommerce' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
                        <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="phone" id="reg_phone" autocomplete="tel" required aria-required="true" />
                    </p>

                    <?php //do_action( 'woocommerce_register_form' ); ?>

                    <p class="form-row">
                        <button type="submit" class="woocommerce-button thm-btn woocommerce-button-register woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Registreren', 'woocommerce' ); ?>"><?php esc_html_e( 'Registreren', 'woocommerce' ); ?></button>
                    </p>

                    <div class="form-register-link">
                        <a href="<?php echo esc_url( wc_get_account_endpoint_url('') ); ?>"><?php esc_html_e( 'Heb je al een account? Inloggen', 'woocommerce' ); ?></a>
                    </div>

                    <?php do_action( 'woocommerce_register_form_end' ); ?>
                </form>
                <?php mori_logo(); ?>
            </div>
        </div>
    </div>
</div>
<?php do_action( 'woocommerce_after_customer_register_form' ); ?>