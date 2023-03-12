<?php
global $post;

if ( empty($courses) ) {
	return;
}
$classes = array();
if ( $columns == 5 ) {
	$bcol = 'cus-5';
} else {
	$bcol = 12/$columns;
}
if ( $columns >= 4 ) {
	$md_columns = 3;
} else {
	$md_columns = $columns;
}
$md_bcol = 12/$md_columns;
$classes[] = 'col-lg-'.$bcol.' col-md-'.$md_bcol.( $columns > 1 ? ' col-sm-6' : 'col-xs-12');

?>
<div class="row">

	<?php $i = 0; foreach ( $courses as $course_id ) {
			$post = get_post( $course_id );
			setup_postdata( $post );
			$eclasses = $classes;
			if ( $i%$columns == 0 ) {
				$eclasses[] = 'lg-clearfix';
			}
			if ( $i%$md_columns == 0 ) {
				$eclasses[] = 'md-clearfix';
			}
			if ( $columns > 1 && $i%2 == 0 ) {
				$eclasses[] = 'sm-clearfix';
			}
	?>
			<div class="<?php echo implode(' ', $eclasses); ?>">
			 	<?php learn_press_get_template_part( 'content-course' ); ?>
			</div>
	<?php $i++; } ?>

</div>
<?php wp_reset_postdata(); ?>