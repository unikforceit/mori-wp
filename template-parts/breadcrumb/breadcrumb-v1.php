<?php
$arg = [
    'cat' => '<span class="niotitle">' . esc_html__('Category', 'mori') . '</span>',
    'tag' => '<span  class="niotitle">' . esc_html__('Tag', 'mori') . '</span>',
    'author' => '<span  class="niotitle">' . esc_html__('Author', 'mori') . '</span>',
    'year' => '<span  class="niotitle">' . esc_html__('Year', 'mori') . '</span>',
    'notfound' => '<span  class="niotitle">' . esc_html__('Not found', 'mori') . '</span>',
    'search' => '<span  class="niotitle">' . esc_html__('Search for', 'mori') . '</span>',
    'marchive' => '<span  class="niotitle">' . esc_html__('Monthly archive', 'mori') . '</span>',
    'yarchive' => '<span  class="niotitle">' . esc_html__('Yearly archive', 'mori') . '</span>',
];

if (is_home() && get_option('page_for_posts')) {
    $title = 'Blog';
} elseif (is_front_page()) {
    $title = 'Front Page';
} else {
    $title = get_the_title();
}
$breadcrumb_bg = !empty(get_the_post_thumbnail_url()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/images/breadcrumb.png';
?>
<!-- Start Page Title Banner -->
<section class="breadcrumb-section" data-background="<?php echo esc_url($breadcrumb_bg)?>">
    <div class="container">
        <h2><?php echo esc_html($title); ?></h2>
        <nav aria-label="breadcrumb">
            <?php mori_unit_breadcumb(); ?>
        </nav>
    </div>
</section>
<!-- End Page Title Banner -->
