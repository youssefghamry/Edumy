<?php
/**
 * Template for displaying instructor of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/instructor.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();

?>

<div class="course-author">

    <h3><?php esc_html_e( 'About the Instructor', 'edumy' ); ?></h3>

    <div class="author-image">
		<?php echo wp_kses_post($course->get_instructor()->get_profile_picture()); ?>
    </div>
    <div class="content">

    	<?php echo wp_kses_post($course->get_instructor_html()); ?>
    	<div class="author-bio">
			<?php echo wp_kses_post($course->get_author()->get_description()); ?>
	    </div>
    </div>
    

</div>