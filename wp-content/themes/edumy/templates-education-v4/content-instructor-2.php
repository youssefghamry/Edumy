<?php

defined( 'ABSPATH' ) || exit();


$profile = LP_Profile::instance($instructor->ID);

$user = $profile->get_user();
$args = array(
    'author' => $instructor->ID,
    'fields' => 'ids',
);
$courses = edumy_get_courses($args);
$course_count = !empty($courses) ? count($courses) : 0;
$students = 0;
if ( !empty($courses) ) {
    foreach ($courses as $course_id) {
        $students += intval(get_post_meta($course_id, '_lp_students', true));
    }
}
?>

<div <?php post_class('instructor-grid'); ?>>
    <div class="instructor-grid-inside">
        <!-- instructor thumbnail -->
        <?php
            $image = $user->get_profile_picture();
            if ( $image ) {
                ?>
                <div class="instructor-cover">
                    <a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>">
                        <?php echo wp_kses_post($image); ?>
                    </a>
                </div>
                <?php
            } else {
                ?>
                <div class="instructor-cover no-image">
                    <a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>">
                        
                    </a>
                </div>
                <?php
            }
        ?>
        <h3 class="instructor-name"><a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>"><?php echo wp_kses_post($user->get_display_name()); ?></a></h3>
        <?php
            $info = get_user_meta( $instructor->ID, 'apus_edr_info',true );
            if ( !empty($info) && !empty($info['job']) ) {
                ?>
                <div class="job"><?php echo esc_html($info['job']); ?></div>
                <?php
            }
        ?>
        <div class="metas">
            <div class="students"><?php echo sprintf(_n('%d student', '%d students', $students, 'edumy'), $students); ?></div>
            <div class="courses"><?php echo sprintf(_n('%d course', '%d courses', $course_count, 'edumy'), $course_count); ?></div>
        </div>
    </div>
</div>