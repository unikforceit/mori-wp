<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Mori
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mori_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }


    return $classes;
}

add_filter('body_class', 'mori_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function mori_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('wp_head', 'mori_pingback_header');

/**
 * Custom styles. See customizer-typography for typography styles.
 */
function mori_custom_styles()
{
    echo '<style type="text/css">';


    echo '</style>';

}

add_action('wp_head', 'mori_custom_styles');

function mori_pagination()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<ul>' . "\n";

    /** Previous Post Link */
    if (get_previous_posts_link())
        printf('<li>%s</li>' . "\n", get_previous_posts_link('<i class="fas fa-angle-left"></i>'));

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="pegi-active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="pegi-active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    /** Next Post Link */
    if (get_next_posts_link())
        printf('<li>%s</li>' . "\n", get_next_posts_link('<i class="fas fa-angle-right"></i>'));

    echo '</ul>' . "\n";

}

function mori_unit_breadcumb()
{
    global $wp_query, $post, $paged;
    $space = ' ';
    $on_front = get_option('show_on_front');
    $blog_page = get_option('page_for_posts');
    $separator = $space . '<li class="breadcrumb-item sep"><i class="fas fa-angle-right"></i></li>' . $space;
    $link = apply_filters('dm_breadcrumb_link', '<li class="breadcrumb-item"><a href="%1$s" title="%2$s" rel="bookmark" class="%2$s">%2$s</a></li>');
    $current = apply_filters('dm_breadcrumb_current', '<li class="breadcrumb-item active">%s</li>');
    if (($on_front == 'page' && is_front_page()) || ($on_front == 'posts' && is_home())) {
        return;
    }
    $out = '<ol class="breadcrumb">';
    if ($on_front == "page" && is_home()) {
        $blog_title = isset($blog_page) ? get_the_title($blog_page) : __('Our Blog', 'mori');
        $out .= sprintf($link, home_url(), __('Home', 'mori')) . $separator . sprintf($current, $blog_title);
    } else {
        $out .= sprintf($link, home_url(), __('Home', 'mori'));
    }
    if (is_singular()) {
        if (is_singular('post') && $blog_page > 0) {
            $out .= $separator . sprintf($link, get_permalink($blog_page), esc_attr(get_the_title($blog_page)));
        }
        if ($post->post_parent > 0) {
            if (isset($post->ancestors)) {
                if (is_array($post->ancestors))
                    $ancestors = array_values($post->ancestors);
                else
                    $ancestors = array($post->ancestors);
            } else {
                $ancestors = array($post->post_parent);
            }
            foreach (array_reverse($ancestors) as $key => $value) {
                $out .= $separator . sprintf($link, get_permalink($value), esc_attr(get_the_title($value)));
            }
        }
        $post_type = get_post_type();
        if (get_post_type_archive_link($post_type)) {
            $post_type_obj = get_post_type_object($post_type);
            $out .= $separator . sprintf($link, get_post_type_archive_link($post_type), esc_attr($post_type_obj->labels->menu_name));
        }
        $out .= $separator . sprintf($current, get_the_title());
    } else {
        if (is_post_type_archive()) {
            $post_type = get_post_type();
            $post_type_obj = get_post_type_object($post_type);
            $out .= $separator . sprintf($current, !empty($post_type_obj->labels->menu_name));
        } else if (is_tax()) {
            if (is_tax('download_tag') || is_tax('download_category')) {
                $post_type = get_post_type();
                $post_type_obj = get_post_type_object($post_type);
                $out .= $separator . sprintf($link, get_post_type_archive_link($post_type), esc_attr($post_type_obj->labels->menu_name));
            }
            $out .= $separator . sprintf($current, $wp_query->queried_object->name);
        } else if (is_category()) {
            $out .= $separator . __('<span class="active">Category ></span> ', 'mori') . sprintf($current, $wp_query->queried_object->name);
        } else if (is_tag()) {
            $out .= $separator . __('Tag: ', 'mori') . sprintf($current, $wp_query->queried_object->name);
        } else if (is_date()) {
            $out .= $separator;
            if (is_day()) {
                global $wp_locale;
                $out .= sprintf($link, get_month_link(get_query_var('year'), get_query_var('monthnum')), $wp_locale->get_month(get_query_var('monthnum')) . ' ' . get_query_var('year'));
                $out .= $separator . sprintf($current, get_the_date());
            } else if (is_month()) {
                $out .= sprintf($current, single_month_title(' ', false));
            } else if (is_year()) {
                $out .= sprintf($current, get_query_var('year'));
            }
        } else if (is_404()) {
            $out .= $separator . sprintf($current, __('Error 404', 'mori'));
        } elseif (is_search()) {
            if (have_posts()) {
                if ($show_home_link && $show_current) echo '<span class="sep">' . $sep . '</span>';
                if ($show_current) echo '<span>' . $before . '</span>' . sprintf($text['search'], get_search_query()) . $after;
            } else {
                if ($show_home_link) echo '<span class="sep">' . $sep . '</span>';
                echo '<span>' . $before . '</span>' . sprintf($text['search'], get_search_query()) . $after;
            }
        }
    }
    $out .= '</ol>';
    echo apply_filters('mori_breadcrumbs_out', $out);
}

function mori_logo()
{
    if (has_custom_logo()) {
        the_custom_logo();
    } else { ?>
        <span class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>"
               rel="home"><?php bloginfo('name'); ?>
            </a>
        </span>
        <div class="site-description">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('description'); ?>
            </a>
        </div>
    <?php }
}

function mori_comment_nav()
{
    // Are there comments to navigate through?
    if (get_comment_pages_count() > 1 && get_option('page_comments')) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Comment navigation', 'mori'); ?></h2>
            <div class="nav-links">
                <?php
                if ($prev_link = get_previous_comments_link(esc_attr__('Older Comments', 'mori'))) :
                    printf('<div class="nav-previous">%s</div>', $prev_link);
                endif;

                if ($next_link = get_next_comments_link(esc_attr__('Newer Comments', 'mori'))) :
                    printf('<div class="nav-next">%s</div>', $next_link);
                endif;
                ?>
            </div><!-- .nav-links -->
        </nav><!-- .comment-navigation -->
    <?php
    endif;
}

function mori_comment_callback($comment, $args, $depth)
{
    if ('div' === $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr($tag); ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="article">
<?php endif; ?>

    <div class="author-pic"><?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 64); ?></div>
    <div class="details">
        <div class="author-meta">
            <?php printf(__('<div class="name"><h4>%s</h4></div>', 'mori'), get_comment_author_link()); ?>
            <div class="date"><span><?php printf(__('%1$s', 'mori'), get_comment_date()); ?></span></div>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'mori'); ?></em>
        <?php endif; ?>

        <?php comment_text(); ?>
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}

function mori_post_tag()
{

    if ('post' == get_post_type()) {

        $posttags = get_the_tags();
        $separator = ' ';
        $output = '';
        if ($posttags) {

            foreach ($posttags as $tag) {
                $output .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>' . $separator;
            }
            $tags = trim($output, $separator);
            echo '<ul>' . $tags . '</ul>';
        }
    }
}

function mori_post_share()
{
    echo '<ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>';
}

function mori_next_pre_post()
{

    $prev_post = get_previous_post();
    $id = $prev_post->ID;
    $permalink1 = get_permalink($id);

    $next_post = get_next_post();
    $nid = $next_post->ID;
    $permalink2 = get_permalink($nid);

    ?>

    <div class="next_prev_post relative-position  d-flex justify-content-between align-items-center flex-wrap">

        <?php if (!empty($id)) { ?>
            <div class="nio_prev_post text-left float-left headline">
                <a href="<?php echo esc_url($permalink1); ?>">
                    <span class="nio-prev-lbl"><?php esc_html_e('Previous Post'); ?></span>
                </a>
            </div>
        <?php } ?>

        <div class="bar_point text-center">
            <i class="fas fa-th"></i>
        </div>

        <?php if (!empty($nid)) { ?>
            <div class="nio_prev_post text-right float-right headline">
                <a href="<?php echo esc_url($permalink2); ?>">
                    <span class="nio-prev-lbl"><?php esc_html_e('Next Post'); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>

<?php }

function mori_related_post()
{
    $related_query = new WP_Query(array(
        'post_type' => 'post',
        'category__in' => wp_get_post_categories(get_the_ID()),
        'post__not_in' => array(get_the_ID()),
        'posts_per_page' => 3,
        'orderby' => 'date',
    ));
    if ($related_query->have_posts()) { ?>
        <div class="mori_related_post">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center">
                <h4 class=""><?php esc_html_e('Related Post'); ?></h4>
                <div class="swiperControler position-relative">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="swiper blogSlider2">
                <div class="swiper-wrapper">
                    <?php while ($related_query->have_posts()) {
                        $related_query->the_post();
                        ?>
                        <div class="swiper-slide">
                            <div class="blog-post-item d-flex flex-column">
                                <?php
                                if (has_post_thumbnail()) { ?>
                                    <div class="thumbImg">
                                        <a href="<?php the_permalink();?>">
                                            <?php the_post_thumbnail('full'); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="content">
                                    <div class="post-dca">
                                        <ul>
                                            <li><a href="#"> <?php the_date('M j, Y'); ?></a></li>
                                        </ul>
                                    </div>
                                    <a class="title" href="<?php the_permalink();?>"><?php the_title();?></a>
                                    <p class="excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12, '');?></p>
                                    <a href="<?php the_permalink();?>" class="permaLink"><?php esc_html_e('Read More', 'mori');?></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php }
}

function mori_dynamic_version() {
    $version = wp_get_theme()->get('Version');
    $timestamp = time();
    return $version.'_time_'.$timestamp;
}

function mori_theme_options($opt)
{
    $options = get_option('_mori');
    if (isset($options[$opt])) {
        return $options[$opt];
    }
}

function mori_theme_page_meta($opt)
{
    $options = get_post_meta(get_the_ID(), '_mori_meta', true);
    if (isset($options[$opt])) {
        return $options[$opt];
    }
}

function mori_translated_text($text)
{
    if (!empty($text)) {
        _e($text, 'mori');
    }
}

function mori_svg_icons($icon_name)
{
    echo '<i class="mori-svg">'.file_get_contents(get_template_directory_uri(). '/assets/icons/'.$icon_name.'.svg').'</i>';
}
function mori_theme_image($image_name, $class = 'mori-image')
{
    echo '<img class="'.$class.'" src="'.get_template_directory_uri(). '/images/'.$image_name.'">';
}
// In your theme's functions.php or a custom plugin
function get_theme_svg_icons() {
    $icons_path = get_template_directory() . '/assets/icons/';
    $icons_url = get_template_directory_uri() . '/assets/icons/';
    $icons = array();

    // Check if directory exists
    if (!file_exists($icons_path)) {
        return $icons;
    }

    // Scan directory for SVG files
    $files = scandir($icons_path);

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'svg') {
            $icon_name = pathinfo($file, PATHINFO_FILENAME);
            $icons[$icon_name] = ucfirst(str_replace('-', ' ', $icon_name));
        }
    }

    return $icons;
}

/**
 * Replace <i> tags with SVG content
 */
function replace_icon_tags_with_svg($content) {
    // Only run on frontend
    if (is_admin()) return $content;

    // Find all <i> tags with icon- classes
    preg_match_all('/<i class="[^"]*icon-([^"\s]+)[^"]*"[^>]*><\/i>/', $content, $matches);

    if (empty($matches[1])) return $content;

    foreach ($matches[1] as $index => $icon_name) {
        $svg_path = get_template_directory() . '/assets/icons/' . $icon_name . '.svg';

        if (file_exists($svg_path)) {
            $svg_content = file_get_contents($svg_path);
            // Clean up SVG (remove XML declaration and comments)
            $svg_content = preg_replace('/<\?xml.*?\?>|<!--.*?-->/s', '', $svg_content);
            // Preserve original classes
            $original_tag = $matches[0][$index];
            preg_match('/class="([^"]*)"/', $original_tag, $class_matches);
            $classes = isset($class_matches[1]) ? $class_matches[1] : '';
            // Replace <i> with SVG
            $content = str_replace(
                $original_tag,
                '<span class="mori-svg-icon ' . esc_attr($classes) . '">' . $svg_content . '</span>',
                $content
            );
        }
    }

    return $content;
}
add_filter('the_content', 'replace_icon_tags_with_svg', 20);
add_filter('widget_text', 'replace_icon_tags_with_svg', 20);
add_filter('wp_nav_menu_items', 'replace_icon_tags_with_svg', 20);