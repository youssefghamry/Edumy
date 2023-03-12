<?php
global $post;

if ( empty($instructors) ) {
	return;
}
$classes = array();
if ( $columns == 5 ) {
	$bcol = 'cus-5';
} else {
	$bcol = 12/$columns;
}
$classes[] = 'col-lg-'.$bcol.' col-md-'.$bcol.( $columns > 1 ? ' col-sm-6' : 'col-xs-12');

$file_name = 'content-instructor';
if ( $item_style == 'style2' ) {
    $file_name = 'content-instructor-2';
}
?>
<div class="row">

	<?php foreach ( $instructors as $instructor ) { ?>
			<div class="<?php echo implode(' ', $classes); ?>">
			 	<?php learn_press_get_template( $file_name, array('instructor' => $instructor) ); ?>
			</div>
	<?php } ?>
	
</div>
<?php wp_reset_postdata(); ?>