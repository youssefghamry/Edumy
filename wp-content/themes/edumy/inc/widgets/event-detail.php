<?php

class Edumy_Widget_Event_Detail extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_event_detail',
            esc_html__('Single Event:: Detail', 'edumy'),
            array( 'description' => esc_html__( 'Show list of event detail', 'edumy' ), )
        );
        $this->widgetName = 'event_detail';
    }

    public function getTemplate() {
        $this->template = 'event-detail.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Event Details',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'edumy' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;

    }
}
if ( function_exists('apus_framework_reg_widget') ) {
    apus_framework_reg_widget('Edumy_Widget_Event_Detail');
}