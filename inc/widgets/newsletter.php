<?php
/**
 * Custom HTML and Shortcode Widget for WordPress
 */
class Custom_Html_Shortcode_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'custom_html_shortcode_widget', // Base ID
            __('Mori Newsletter', 'mori'), // Name
            array('description' => __('Widget with title, HTML content, and shortcode fields', 'mori')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        // Title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        echo '<div class="newsletter-footer">';
        // HTML Content
        if (!empty($instance['html_content'])) {
            echo '<div class="newsletter-html-form">';
            echo apply_filters('widget_text', $instance['html_content']);
            echo '</div>';
        }

        // Shortcode
        if (!empty($instance['shortcode'])) {
            echo '<div class="newsletter-shortcode-form">';
            echo do_shortcode($instance['shortcode']);
            echo '</div>';
        }
        echo '</div>';

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('', 'mori');
        $html_content = !empty($instance['html_content']) ? $instance['html_content'] : '';
        $shortcode = !empty($instance['shortcode']) ? $instance['shortcode'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('html_content')); ?>"><?php _e('HTML Content:'); ?></label>
            <textarea class="widefat" rows="10" id="<?php echo esc_attr($this->get_field_id('html_content')); ?>" name="<?php echo esc_attr($this->get_field_name('html_content')); ?>"><?php echo esc_textarea($html_content); ?></textarea>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('shortcode')); ?>"><?php _e('Shortcode:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('shortcode')); ?>" name="<?php echo esc_attr($this->get_field_name('shortcode')); ?>" type="text" value="<?php echo esc_attr($shortcode); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['html_content'] = (!empty($new_instance['html_content'])) ? $new_instance['html_content'] : '';
        $instance['shortcode'] = (!empty($new_instance['shortcode'])) ? sanitize_text_field($new_instance['shortcode']) : '';

        return $instance;
    }
}

// Register the widget
function register_custom_html_shortcode_widget() {
    register_widget('Custom_Html_Shortcode_Widget');
}
add_action('widgets_init', 'register_custom_html_shortcode_widget');