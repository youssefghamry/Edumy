<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Edumy
 * @since Edumy 1.0
 */
/*
*Template Name: Page Profile template
*/

get_header();
$sidebar_configs = edumy_get_page_layout_configs();

edumy_render_breadcrumbs();
?>

<section id="main-container" class="main-content <?php echo apply_filters('edumy_page_content_class', 'container');?> inner">
	
	<div class="row">
		
		<div id="main-content" class="main-page col-md-9 col-sm-12 col-xs-12">
			<div id="main" class="site-main clearfix" role="main">

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
					
					// Include the page content template.
					the_content();

				// End the loop.
				endwhile;
				?>
			</div><!-- .site-main -->
			<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'edumy' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'edumy' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
		</div><!-- .content-area -->
		<div class="col-md-3 col-sm-12 col-xs-12 pull-right">
			<div class="sidebar profile-sidebar">
				<?php if ( is_active_sidebar( 'profile-sidebar' ) ): ?>
			   		<?php dynamic_sidebar( 'profile-sidebar' ); ?>
			   	<?php endif; ?>			
			</div>
		</div>
	</div>
</section>
<?php get_footer();