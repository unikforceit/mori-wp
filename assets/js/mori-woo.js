(function($) {
    "use strict";
    $(function() {
    /* global wc_add_to_cart_params */
    if ( typeof wc_add_to_cart_params === 'undefined' ) {
        return false;
    }

    $(document).on('submit', 'form.cart', function(e){

        var form = $(this),
            button = form.find('.single_add_to_cart_button');

        var formFields = form.find('input:not([name="product_id"]), select, button, textarea');
        // create the form data array
        var formData = [];
        formFields.each(function(i, field){
            // store them so you don't override the actual field's data
            var fieldName = field.name,
                fieldValue = field.value;
            if(fieldName && fieldValue){
                // set the correct product/variation id for single or variable products
                if(fieldName == 'add-to-cart'){
                    fieldName = 'product_id';
                    fieldValue = form.find('input[name=variation_id]').val() || fieldValue;
                }
                // if the fiels is a checkbox/radio and is not checked, skip it
                if((field.type == 'checkbox' || field.type == 'radio') && field.checked == false){
                    return;
                }
                // add the data to the array
                formData.push({
                    name: fieldName,
                    value: fieldValue
                });
            }
        });
        if(!formData.length){
            return;
        }

        e.preventDefault();

        form.block({
            message: null,
            overlayCSS: {
                background: "#ffffff",
                opacity: 0.6
            }
        });
        $(document.body).trigger('adding_to_cart', [button, formData]);

        $.ajax({
            type: 'POST',
            url: woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'),
            data: formData,
            success: function(response){
                if(!response){
                    return;
                }
                if(response.error & response.product_url){
                    window.location = response.product_url;
                    return;
                }

                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, button]);
            },
            complete: function(){
                form.unblock();
            }
        });

        return false;

    });

    $( '.quantity' ).on( 'click', '.plus, .minus', function() {
        var $qty = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal = parseFloat( $qty.val() ),
            max = parseFloat( $qty.attr( 'max' ) ),
            min = parseFloat( $qty.attr( 'min' ) ),
            step = $qty.attr( 'step' );

        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( currentVal >= max ) ) {
                $qty.val( max );
            } else {
                $qty.val( ( currentVal + parseFloat( step )).toFixed( 2 ) );
            }
        } else {
            if ( min && ( currentVal <= min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( ( currentVal - parseFloat( step )).toFixed( 2 ) );
            }
        }

        $qty.trigger( 'change' );
    } );
        jQuery(document.body).on("remove_from_cart", function () {
            jQuery(document.body).trigger('wc_fragment_refresh');
        });

        jQuery(document.body).on("added_to_cart", function () {
            jQuery(document.body).trigger('wc_fragment_refresh');
        });

        jQuery(document.body).on('added_to_cart', function () {
            jQuery("body").addClass('cart-activee');
        });
    });
}(jQuery));
