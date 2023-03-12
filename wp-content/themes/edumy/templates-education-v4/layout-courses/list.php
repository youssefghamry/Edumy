<?php
global $post;

if ( empty($courses) ) {
	return;
}


?>

	<?php $i = 0; foreach ( $courses as $course_id ) {
			$post = get_post( $course_id );
			setup_postdata( $post );
	?>
			 	<?php learn_press_get_template_part( 'content-course-list-wislist' ); ?>
	<?php $i++; } ?>

<?php wp_reset_postdata(); ?>