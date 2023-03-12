<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Edumy
 * @since Edumy 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
edumy_render_breadcrumbs();

?>
<section class="page-404">
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found clearfix text-center">
				<div class="container">
					<div class="row flex-middle-sm">
						<div class="col-sm-12 col-lg-12 col-md-12 col-xs-12">
							<div class="slogan">
								<?php if(!empty(edumy_get_config('404_title', '404')) ) { ?>
									<h4 class="title-big"><?php echo wp_kses_post(edumy_get_config('404_title', '404')); ?></h4>
								<?php } ?>
							</div>
							<div class="page-content">
								<div class="description">
									<?php echo wp_kses_post(edumy_get_config('404_description', 'It looks like nothing was found at this location. Maybe try a search?')); ?>
								</div>
								<?php get_search_form(); ?>
								<div class="return">
									<a class="btn-to-back" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('Back To Homepage','edumy') ?></a>
								</div>
							</div><!-- .page-content -->
						</div>
					</div>
				</div>
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>
