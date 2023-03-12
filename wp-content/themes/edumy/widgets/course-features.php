<?php

global $post;

if ( ! $course = LP_Global::course() ) {
	return;
}

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$duration = $course->get_data( 'duration' );
$language = get_post_meta($post->ID, '_lp_language', true);
$skill_level = get_post_meta($post->ID, '_lp_level', true);
$certificate = get_post_meta($post->ID, '_lp_certificate', true);
$max_students = get_post_meta($post->ID, '_lp_max_students', true);
?>
<div class="course-features-widget">
	
	<ul class="lp-course-info-fields">
        <li class="lp-course-info duration">
            <label><?php esc_html_e( 'Duration', 'edumy' ); ?></label>
            <?php learn_press_label_html( $duration ); ?>
        </li>

        <li class="lp-course-info lessons">
            <label><?php esc_html_e( 'Lessons', 'edumy' ); ?></label>
			<?php learn_press_label_html( $course->count_items( LP_LESSON_CPT ) ); ?>
        </li>

        <li class="lp-course-info quizzes">
            <label><?php esc_html_e( 'Quizzes', 'edumy' ); ?></label>
			<?php learn_press_label_html( $course->count_items( LP_QUIZ_CPT ) ); ?>
        </li>

        <!-- <li class="lp-course-info preview-items">
            <label><?php esc_html_e( 'Preview Lessons', 'edumy' ); ?></label>
			<?php //learn_press_label_html( $course->count_preview_items() ); ?>
        </li> -->
        <?php if ( $max_students ) { ?>
            <li class="lp-course-info max_students">
                <label><?php esc_html_e( 'Maximum Students', 'edumy' ); ?></label>
                <?php learn_press_label_html( $max_students ); ?>
            </li>
        <?php } ?>
        <li class="lp-course-info language">
            <label><?php esc_html_e( 'Language', 'edumy' ); ?></label>
            <?php learn_press_label_html( $language ); ?>
        </li>
        <li class="lp-course-info skill_level">
            <label><?php esc_html_e( 'Skill level', 'edumy' ); ?></label>
            <?php learn_press_label_html( $skill_level ); ?>
        </li>
        <li class="lp-course-info certificate">
            <label><?php esc_html_e( 'Certificate', 'edumy' ); ?></label>
            <?php learn_press_label_html( $certificate ); ?>
        </li>
    </ul>
</div>
