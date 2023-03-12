<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
$sidebar_configs = edumy_get_event_layout_configs();

edumy_render_breadcrumbs();

$display_mode = edumy_get_config( 'events_display_mode', 'grid' );
$columns = edumy_get_config( 'events_columns', 3 );
$bcols = $columns ? 12/$columns : 4;
?>
<section id="main-container" class="main-content  <?php echo apply_filters('edumy_event_content_class', 'container');?> inner">
	<?php edumy_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php edumy_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<main id="main" class="site-main layout-event" role="main">

			<?php if ( have_posts() ) : ?>
				<?php if ( $display_mode == 'grid' ) { ?>
					<div class="row">
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="col-sm-<?php echo esc_attr($bcols); ?>">
								<?php echo ApusSimpleEvent_Template_Loader::get_template_part( 'loop/inner' ); ?>
							</div>
						<?php endwhile; ?>
					</div>
				<?php } else { ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php echo ApusSimpleEvent_Template_Loader::get_template_part( 'loop/inner-list' ); ?>
					<?php endwhile; ?>
				<?php } ?>

				<?php

				// Previous/next page navigation.
				edumy_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-posts/content', 'none' );
			endif;
			?>

			</main><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php edumy_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php get_footer();