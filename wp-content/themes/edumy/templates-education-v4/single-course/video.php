<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$course = learn_press_get_course();

$video_url = get_post_meta($post->ID, '_lp_video_url', true);
if ( !empty($video_url) ) {
?>
    <div class="course-video">
        <?php echo do_shortcode( '[video src="'.esc_url( $video_url ).'"]' ); ?>
    </div>
<?php } elseif ( $image = $course->get_image( 'full' ) ) { ?>
	<div class="course-cover">
        <?php echo wp_kses_post($image); ?>
    </div>
<?php } ?>