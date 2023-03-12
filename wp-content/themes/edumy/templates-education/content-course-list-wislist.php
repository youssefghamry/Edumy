<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $post;
?>

<div id="wishlist-course-<?php echo esc_attr($post->ID); ?>" <?php post_class('course-list my-course-item-wrapper'); ?>>

    <?php
    $course = learn_press_get_course( $post->ID );
    ?>

    <div class="course-entry">
        <!-- course thumbnail -->
        <?php if ( $image = $course->get_image( 'medium' ) ) { ?>            
            <div class="course-cover">
                <div class="course-cover-thumb"> 
                    <a href="<?php echo esc_url($course->get_permalink()); ?>">
                        <?php echo wp_kses_post($image); ?>
                    </a>

                    <div class="course-cover-label">
                        <a href="javascript:void(0);" class="apus-wishlist-remove" data-id="<?php echo esc_attr($post->ID); ?>">
                            <?php echo esc_html__('Remove', 'edumy'); ?>
                        </a>                        
                    </div>
                </div>
            </div>               
        <?php } ?>
        <div class="course-detail">
            <!-- course teacher -->
            <div class="course-teacher"><?php echo wp_kses_post($course->get_instructor_html()); ?></div>

            <!-- course title -->
            <a href="<?php echo get_the_permalink( $course->get_id() ) ?>">
                <h3 class="course-title"><?php echo wp_kses_post($course->get_title()); ?></h3>
            </a>

            <?php if ( get_the_excerpt() ) { ?>                    
                <div class="course-excerpt"><?php echo wp_kses_post(edumy_substring( get_the_excerpt(),27, '...' )); ?></div>
            <?php } ?>
            
            <div class="course-meta-data flex-middle">

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

                <div class="course-meta-comparison">
                    <!-- rating -->
                    <?php
                        $rating_avg = Edumy_Course_Review::get_ratings_average($post->ID);
                        $ratings_count = Edumy_Course_Review::get_total_reviews($post->ID);
                        Edumy_Course_Review::print_review($rating_avg, 'list', $ratings_count);
                    ?>
                    <!-- price -->

                    <div class="course-meta-field course-meta-price">
                        <?php LP()->template( 'course' )->courses_loop_item_price(); ?>
                    </div>                        
                </div>            

            </div>
        </div>        
    </div>
</div>