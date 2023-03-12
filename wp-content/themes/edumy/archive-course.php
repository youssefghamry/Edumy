<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( edumy_is_new_learnpress('4.0.0') ) {
	get_header();

	$sidebar_configs = edumy_get_course_archive_layout_configs();

	edumy_render_breadcrumbs();
	$display_mode = edumy_get_config('courses_display_mode', 'grid');
	?>

	<section id="main-container" class="main-content  <?php echo apply_filters('edumy_course_content_class', 'container');?> inner">
		<?php edumy_before_content( $sidebar_configs ); ?>
		<div class="row">
			<?php edumy_display_sidebar_left( $sidebar_configs ); ?>

			<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
				<main id="main" class="site-main layout-courses display-mode-<?php echo esc_attr($display_mode); ?>" role="main">
		
					<?php
					/**
					 * LP Hook
					 */
					do_action( 'learn-press/before-courses-loop' );


					$columns = edumy_get_config('courses_columns', 3);
					$classes = '';
					$inner = '';
					if ( $display_mode == 'list' || $display_mode == 'list-v2' ) {
						$classes = 'col-lg-12';
						$inner = 'list';
					} else {
						$bcol = 12/$columns;
						$classes = 'col-lg-'.$bcol.' col-sm-6 col-xs-12';
					}

					LP()->template( 'course' )->begin_courses_loop();

					$i = 0;
					while ( have_posts() ) :
						the_post();

						$eclasses = $classes;
						if ( $i%$columns == 0 ) {
							$eclasses .= ' lg-clearfix';
						}
						if ( $columns > 1 && $i%2 == 0 ) {
							$eclasses .= ' md-clearfix sm-clearfix';
						}
						?>
						<div class="<?php echo esc_attr($eclasses); ?>">
							<?php learn_press_get_template_part( 'content-course', $inner ); ?>
						</div>
						<?php
						$i++;

					endwhile;

					LP()->template( 'course' )->end_courses_loop();

					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/after-courses-loop' );


					/**
					 * LP Hook
					 */
					// do_action( 'learn-press/after-main-content' );

					edumy_paging_nav();
					
					?>

				</main><!-- .site-main -->
			</div><!-- .content-area -->
			
			<?php edumy_display_sidebar_right( $sidebar_configs ); ?>
			
		</div>
	</section>

	<?php

	get_footer();
} else {
	get_header();

	// Start the loop.
	while ( have_posts() ) : the_post();
		
		// Include the page content template.
		the_content();
		
	// End the loop.
	endwhile;

	get_footer();
}
