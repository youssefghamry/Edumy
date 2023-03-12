<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
$course = learn_press_get_course();

?>
<div class="course-meta">
    <div class="course-header">
        <div class="course-header-top">
            <div class="course-header-teacher-wrapper">
                <div class="teacher-info">
                    <div class="avatar-img">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ),80 ); ?>
                    </div>
                    <h4 class="author-title"><?php echo get_the_author(); ?></h4>
                </div>
                <div class="update-info">
                    <?php echo sprintf(esc_html__('Last updated %s', 'edumy'), get_the_modified_time(get_option('date_format'))); ?>
                </div>
            </div>
            <div class="course-header-buttons">
                <?php Edumy_Wishlist::display_wishlist_btn($post); ?>
                <div class="share-wrapper">
                    <a href="javascript:void(0)" class="btn course-share"><i class="flaticon-share"></i> <?php esc_html_e('Share', 'edumy'); ?></a>
                    <?php get_template_part('template-parts/sharebox'); ?>
                </div>
            </div>
        </div>
        <div class="course-header-middle">
            <h2 class="title"><?php the_title(); ?></h2>
        </div>
        <div class="course-header-bottom">        
            <div class="rating">
                <?php
                    $rating_avg = Edumy_Course_Review::get_ratings_average($post->ID);
                    $ratings_count = Edumy_Course_Review::get_total_reviews($post->ID);
                    Edumy_Course_Review::print_review($rating_avg, 'detail', $ratings_count);
                ?>
            </div>
            <?php
                $count = $course->get_users_enrolled();
            ?>
            <span class="course-students1">
                <i class="flaticon-profile"></i>
                <?php echo sprintf(_n('%d student', '%d students', $count, 'edumy'), $count); ?>
            </span>
        </div>
    </div>
</div>