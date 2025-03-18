<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mori
 */

get_header();
?>

    <div class="blog-content section-gap">
        <div class="container">
            <header class="page-header">
                <h2 class="page-title"><?php esc_html_e('The page you are looking for is not found!', 'mori'); ?></h2>
            </header><!-- .page-header -->
            <div class="page-content">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="more-link theme-button">
                    <?php esc_html_e('Back To Home', 'mori'); ?> <i class="fas fa-angle-right"></i></a>
            </div><!-- .page-content -->
        </div><!-- .error-404 -->

    </div><!-- #main -->

<?php
get_footer();
