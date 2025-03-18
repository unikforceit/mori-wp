(function($) {
    "use strict";
    $(function() {

        //-----------------------------------------------------
        // [2] Ajax load products - On Click
        //-----------------------------------------------------
        $('#mori_loadmore_products').click(function(){

            var button = $(this),
                data = {
                    'action': 'mori_loadmore_products',
                    'query': mori_ajax.posts, // that's how we get params from wp_localize_script() function
                    'page' : mori_ajax.current_page
                };

            $.ajax({
                url : mori_ajax.ajaxurl, // AJAX handler
                data : data,
                related_products : 'no',
                type : 'POST',
                beforeSend : function ( xhr ) {
                    button.addClass('loading');
                    button.text('LOADING ...'); // change the button text, you can also add a preloader image
                },
                success : function( data ){
                    if( data ) {
                        $("#container_products_more").prev("ul.products").append( data ); // where to insert posts
                        button.removeClass('loading');
                        button.text( 'LOAD MORE' );
                        mori_ajax.current_page++;

                        if ( mori_ajax.current_page == mori_ajax.max_page )
                            button.text( 'NO MORE' ).attr('disabled', true); // if last page, remove the button
                    } else {
                        button.text( 'NO MORE' ).attr('disabled', true); // if no data, remove the button as well
                    }
                }
            });
        });

    });
}(jQuery));