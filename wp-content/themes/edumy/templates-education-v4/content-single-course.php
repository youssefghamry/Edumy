<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-single-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( post_password_required() ) {
	echo get_the_password_form();

	return;
}



$sidebar_configs = edumy_get_course_single_layout_configs();
edumy_render_breadcrumbs();


?>
<section id="main-container" class="main-content <?php echo apply_filters( 'edumy_course_content_class', 'container' ); ?> inner">
	<div class="row">
		<div id="main-content" class="col-xs-12">
			<div id="primary" class="content-area">
				<div id="content" class="site-content detail-course" role="main">

					<?php do_action( 'edumy_single_course_header' ); ?>
					
					<div class="row">
						<div class="col-md-9 col-sm-12 col-xs-12 <?php echo esc_attr($sidebar_configs['main_class']); ?>">
							<?php
								/**
									 * @since 3.0.0
									 */
									do_action( 'learn-press/before-main-content' );

									do_action( 'learn-press/before-single-course' );

									?>
									<div id="learn-press-course" class="course-summary">
										<?php
										/**
										 * @since 3.0.0
										 *
										 * @see learn_press_single_course_summary()
										 */
										do_action( 'learn-press/single-course-summary' );
										?>
									</div>
									<?php

									/**
									 * @since 3.0.0
									 */
									do_action( 'learn-press/after-main-content' );

									do_action( 'learn-press/after-single-course' );
							?>
						</div>
						<div class="col-md-3 col-sm-12 col-xs-12 <?php echo esc_attr($sidebar_configs['sidebar_class']); ?>">
							<?php if ( is_active_sidebar( 'edumy-course-single-sidebar' ) ) { ?>
								<div class="widget-area sidebar" role="complementary">
									<?php dynamic_sidebar( 'edumy-course-single-sidebar' ); ?>
								</div>
							<?php } ?>
						</div>
						<div class="col-md-9 col-sm-12 col-xs-12 <?php echo esc_attr($sidebar_configs['main_class']); ?>">
							<!-- review/ releated -->
							<?php
								// if ( comments_open() || get_comments_number() ) :
								// 	comments_template();
								// endif;

								if ( edumy_get_config('show_course_releated', false) ):
									get_template_part( 'templates-education/single-course/courses-releated' );
				                endif;
							?>
						</div>
					</div>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
		
	</div>	
</section>