<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $post;
$course = learn_press_get_course( $post->ID );
if ( empty($course) ) {
    return;
}
?>

<div <?php post_class('course-grid w-100'); ?>>

    <div class="course-entry">

        <!-- course thumbnail -->
		<?php if ( $image = $course->get_image( 'edumy-course-grid' ) ) { ?>
            <div class="course-cover">
                <div class="course-cover-thumb"> 
                    <a href="<?php echo esc_url($course->get_permalink()); ?>">
                        <?php echo wp_kses_post($image); ?>
                    </a>
                    <?php Edumy_Wishlist::display_wishlist_btn($post); ?>
                    <div class="course-cover-label">
                        <a href="<?php echo esc_url($course->get_permalink()); ?>">
                            <?php echo esc_html__('Preview Course', 'edumy'); ?>
                        </a>
                    </div>
                </div>                
            </div>
		<?php } ?>

        <div class="course-detail">
            <div class="course-info-box">
                <!-- course teacher -->
                <div class="course-teacher"><?php echo wp_kses_post($course->get_instructor_html()); ?></div>

                <!-- course title -->
                <a href="<?php echo get_the_permalink( $course->get_id() ) ?>">
                    <h3 class="course-title"><?php echo wp_kses_post($course->get_title()); ?></h3>
                </a>

                <?php
                    $rating_avg = Edumy_Course_Review::get_ratings_average($post->ID);
                    $ratings_count = Edumy_Course_Review::get_total_reviews($post->ID);
                    Edumy_Course_Review::print_review($rating_avg, 'list', $ratings_count);
                ?>
            </div>        	

            <div class="course-meta-data">

                <div class="course-meta-number">
                    <!-- number students -->
                    <div class="course-student-number course-meta-field">
                        <i class="flaticon-profile"></i>
                        <?php
                            $count = $course->get_users_enrolled();
                            echo intval($count);
                        ?>
                    </div>

                    <!-- number lessons -->
                    <div class="course-lesson-number course-meta-field">
                        <i class="flaticon-comment"></i>
                        <?php
                            $lesson_count = $course->count_items( LP_LESSON_CPT );
                            echo intval($lesson_count);
                        ?>
                    </div>
                </div>              
                <!-- price -->
                <div class="course-meta-field course-meta-price">
                    
                    <?php LP()->template( 'course' )->courses_loop_item_price(); ?>
                </div>
            </div>
        </div>
    </div>
</div>