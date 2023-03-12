<?php
/**
 * Template for displaying content of page for processing checkout feature.
 *
 * @author   ThimPress
 * @package  LearnPress/Templates
 * @version  4.0.1
 */

defined( 'ABSPATH' ) or die;

get_header();
$sidebar_configs = edumy_get_page_layout_configs();

edumy_render_breadcrumbs();

?>

<section id="main-container" class="<?php echo apply_filters('edumy_page_content_class', 'container');?> inner">
	<?php edumy_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php edumy_display_sidebar_left( $sidebar_configs ); ?>
		<div id="main-content" class="main-page <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="main" class="site-main clearfix" role="main">


				<div id="learn-press-checkout" class="lp-content-wrap">

					<?php
					/**
					 * LP Hook
					 *
					 * @since 4.0.0
					 */
					do_action( 'learn-press/before-checkout-page' );

					// Shortcode for displaying checkout form
					echo do_shortcode( '[learn_press_checkout]' );

					/**
					 * LP Hook
					 *
					 * @since 4.0.0
					 */
					do_action( 'learn-press/after-checkout-page' );
					?>

				</div>

			</div><!-- .site-main -->
		</div><!-- .content-area -->
		<?php edumy_display_sidebar_right( $sidebar_configs ); ?>
	</div>
</section>
<?php get_footer();