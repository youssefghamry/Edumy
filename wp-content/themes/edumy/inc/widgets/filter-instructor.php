<?php

class Edumy_Widget_Course_Filter_Instructor extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_course_filter_instructor',
            esc_html__('Courses:: Filter Instructors', 'edumy'),
            array( 'description' => esc_html__( 'Show list of course filter instructor', 'edumy' ), )
        );
        $this->widgetName = 'course_filter_instructor';
    }

    public function getTemplate() {
        $this->template = 'filter-instructor.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Instructors',
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
    apus_framework_reg_widget('Edumy_Widget_Course_Filter_Instructor');
}