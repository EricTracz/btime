<?php
/*
Plugin Name: Display Blog Time
Plugin URI: http://www.erictra.cz
Description: Widget displaying blog time
Author: Arkadiusz 'Eric' Tracz
Version: 0.8
Author URI: http://www.erictra.cz
Created with the help of: http://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-wordpress-widget/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: btime
Domain Path: /language
Display Blog Time is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Display Blog Time is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY. See the
GNU General Public License for more details.
 */

// Creating the widget
class et_btime_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
            'et_btime_widget',

// Widget name will appear in UI
            __('Blog Time Widget', 'et_btime_widget_btime'),

// Widget description
            array( 'description' => __( 'The widget displays currently set blogtime.', 'et_btime_widget_btime' ), )
        );
    }

// Creating widget front-end
// This is where the action happens

    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
// =============================================================
// ======================== MAGIC ==============================
// =============================================================
        

        $data = date_i18n( get_option( 'date_format' ), strtotime( '11/15-1976' ) );
        echo $data;

        echo "<BR>";

        $time = current_time(get_option('time_format'));
        echo $time;


        echo $args['after_widget'];
    }

// Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'et_btime_widget_btime' );
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class et_btime_widget ends here

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'et_btime_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

/* Stop Adding Functions Below this Line */

//EOF
