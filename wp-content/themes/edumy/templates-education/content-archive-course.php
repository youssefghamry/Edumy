<?php
/**
 * Template for displaying archive course content.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-archive-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

global $post, $wp_query, $lp_tax_query, $wp_query;

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
					 * @since 3.0.0
					 */
					do_action( 'learn-press/before-main-content' );

					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/archive-description' );

					do_action( 'edumy-learn-press/after-archive-description' );

					if ( LP()->wp_query->have_posts() ) :

						/**
						 * @since 3.0.0
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
						learn_press_begin_courses_loop();
						
						$i = 0;
						while ( LP()->wp_query->have_posts() ) : LP()->wp_query->the_post();
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

						learn_press_end_courses_loop();

						/**
						 * @since 3.0.0
						 */
						do_action( 'learn_press_after_courses_loop' );

						wp_reset_postdata();

					else:
						learn_press_display_message( esc_html__( 'No course found.', 'edumy' ), 'error' );
					endif;

					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/after-main-content' );

					edumy_paging_nav();
				?>
			</main><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php edumy_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>