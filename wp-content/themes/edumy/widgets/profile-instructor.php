<?php

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$profile = LP_Global::profile();
$user = LP_Profile::instance()->get_user();
$user_id = $user->get_id();

$args = array(
    'author' => $user_id,
    'fields' => 'ids',
);
$courses = edumy_get_courses($args);
$course_count = !empty($courses) ? count($courses) : 0;
$students = 0;
$reviews = 0;
if ( !empty($courses) ) {
    foreach ($courses as $course_id) {
        $students += intval(get_post_meta($course_id, '_lp_students', true));
        $reviews += Edumy_Course_Review::get_total_reviews( $course_id );
    }
}

?>
<div class="profile-info-widget">
	<div class="profile-item">
		<div class="label"><?php esc_html_e('Total students', 'edumy'); ?></div>
		<div class="value"><?php echo esc_html($students); ?></div>
	</div>
	<div class="profile-item">
		<div class="label"><?php esc_html_e('Courses', 'edumy'); ?></div>
		<div class="value"><?php echo esc_html($course_count); ?></div>
	</div>
	<div class="profile-item">
		<div class="label"><?php esc_html_e('Reviews', 'edumy'); ?></div>
		<div class="value"><?php echo esc_html($reviews); ?></div>
	</div>

</div>
