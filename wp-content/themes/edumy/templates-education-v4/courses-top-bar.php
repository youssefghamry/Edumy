<?php
/**
 * Template for displaying top-bar in archive course page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.1
 */

defined( 'ABSPATH' ) || exit;

$layouts = learn_press_courses_layouts();
$active  = learn_press_get_courses_layout();
$s       = LP_Request::get( 's' );
?>

<div class="lp-courses-bar1 <?php echo esc_attr( $active ); ?>">
	<div class="course-top-wrapper">
		<?php edumy_course_loop_found_post(); ?>

		<form class="search-courses learn-press-search-course-form" method="post">
			<input type="hidden" name="post_type" value="<?php echo esc_attr( LP_COURSE_CPT ); ?>">
			<input type="hidden" name="taxonomy" value="<?php echo esc_attr( get_queried_object()->taxonomy ?? $_GET['taxonomy'] ?? '' ); ?>">
			<input type="hidden" name="term_id" value="<?php echo esc_attr( get_queried_object()->term_id ?? $_GET['term_id'] ?? '' ); ?>">
			<input type="hidden" name="term" value="<?php echo esc_attr( get_queried_object()->slug ?? $_GET['term'] ?? '' ); ?>">
			<input class="search-course-input" type="text" placeholder="<?php esc_attr_e( 'Search courses...', 'edumy' ); ?>" name="s" value="<?php echo esc_attr( $s ); ?>">
			<button type="submit" class="lp-button button search-course-button"><i class="fas fa-search"></i></button>
		</form>

		<?php edumy_course_loop_orderby(); ?>
	</div>
</div>
