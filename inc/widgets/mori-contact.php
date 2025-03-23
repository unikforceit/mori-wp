<?php
// Adds widget: Mori Contact
class Moricontact_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'moricontact_widget',
            esc_html__( 'Mori Contact', 'mori' )
        );
    }

    private $widget_fields = array(
        array(
            'label' => 'Text',
            'id' => 'text',
            'type' => 'text',
        ),
        array(
            'label' => 'Email',
            'id' => 'email',
            'type' => 'text',
        ),
        array(
            'label' => 'Contact',
            'id' => 'contact',
            'type' => 'text',
        ),
    );

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
        <div class="mori-contact-widget ul-li">
            <ul>
                <li><a href="<?php echo home_url('/');?>"><?php mori_translated_text($instance['text']);?></a></li>
                <li><a href="mailto:<?php echo esc_url($instance['email']);?>"><?php mori_translated_text($instance['email']);?></a></li>
                <li><a href="callto:<?php echo esc_url($instance['contact']);?>"><?php mori_translated_text($instance['contact']);?></a></li>
            </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function field_generator( $instance ) {
        $output = '';
        foreach ( $this->widget_fields as $widget_field ) {
            $default = '';
            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }
            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'mori' );
            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'mori' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }
        echo $output;
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'mori' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'mori' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
        $this->field_generator( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }
        return $instance;
    }
}

function register_moricontact_widget() {
    register_widget( 'Moricontact_Widget' );
}
add_action( 'widgets_init', 'register_moricontact_widget' );