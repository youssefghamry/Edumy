<?php

class Edumy_Widget_Course_Filter_Rating extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_course_filter_rating',
            esc_html__('Courses:: Filter Ratings', 'edumy'),
            array( 'description' => esc_html__( 'Show list of course filter rating', 'edumy' ), )
        );
        $this->widgetName = 'course_filter_rating';
    }

    public function getTemplate() {
        $this->template = 'filter-rating.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Ratings',
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
    apus_framework_reg_widget('Edumy_Widget_Course_Filter_Rating');
}