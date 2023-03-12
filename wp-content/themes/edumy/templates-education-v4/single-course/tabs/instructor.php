<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.3.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
$user = $course->get_instructor();
$user_id = $user->get_id();

$rating = get_user_meta($user_id, '_average_rating', true );

$args = array(
    'author' => $user_id,
    'fields' => 'ids',
);
$courses = edumy_get_courses($args);
$course_count = !empty($courses) ? count($courses) : 0;
$students = $nb_reviews = 0;
if ( !empty($courses) ) {
    foreach ($courses as $course_id) {
        $students += intval(get_post_meta($course_id, '_lp_students', true));
        $nb_reviews += Edumy_Course_Review::get_total_reviews( $course_id );
    }
}

?>

<div class="course-author">
	<?php do_action( 'learn-press/before-single-course-instructor' ); ?>
	<div class="author-wrapper">
	    <div class="author-image">
			<?php echo wp_kses_post($course->get_instructor()->get_profile_picture()); ?>
	    </div>
	    <div class="content">
	    	<div class="top-content flex-middle">
	    		<div class="top-content-left">
	    			<div class="ratings">
			    		<?php Edumy_Course_Review::print_review($rating, 'list'); ?>
			    	</div>
	    		</div>
	    		<div class="top-content-right">
	    			<div class="nb-reviews">
		    			<i class="flaticon-comment"></i>
		    			<?php echo sprintf(_n('%d Review', '%d Reviews', $nb_reviews, 'edumy'), number_format($nb_reviews, 0)); ?>
		    		</div>
		    		<div class="nb-students">
		    			<i class="flaticon-profile"></i>
		    			<?php echo sprintf(_n('%d Student', '%d Students', $students, 'edumy'), number_format($students, 0)); ?>
		    		</div>
		    		<div class="nb-course">		    			
		    			<i class="flaticon-play-button-1"></i>		
		    			<?php echo sprintf(_n('%d Course', '%d Courses', $course_count, 'edumy'), number_format($course_count, 0)); ?>
		    		</div>
	    		</div>
	    	</div>

	    	<h3 class="course-link-title"><?php echo wp_kses_post($course->get_instructor_html()); ?></h3>

	    	<div class="author-bio">
				<?php echo wp_kses_post($course->get_author()->get_description()); ?>
		    </div>
	    </div>
    </div>
	<?php do_action( 'learn-press/after-single-course-instructor' ); ?>

</div>