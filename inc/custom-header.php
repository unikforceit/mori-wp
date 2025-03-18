<?php
function mori_custom_header_setup() {
    $args = array(
        'default-image'      => get_template_directory_uri() . '/images/header.png',
        'default-text-color' => '23262F',
        'width'              => 1000,
        'height'             => 250,
        'flex-width'         => true,
        'flex-height'        => true,
        'wp-head-callback'      => 'mori_header_image',
    );
    add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'mori_custom_header_setup' );

function mori_header_image(){
?>
    <style type="text/css">
        .bannerSection .arblgc{
            background-image: url("<?php header_image(); ?>");
        }
    </style>
<?php
}