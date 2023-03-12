<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sidebar_configs = edumy_get_event_layout_configs();
edumy_render_breadcrumbs();
?>
<section id="main-container" class="main-content single-envent-content <?php echo apply_filters( 'edumy_event_content_class', 'container' ); ?> inner">
	<?php edumy_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php edumy_display_sidebar_left( $sidebar_configs ); ?>
		<div id="main-content" class="col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content detail-post" role="main">
					<?php while ( have_posts() ) : the_post(); $event = apussimpleevent_event( get_the_ID() ); ?>
						<?php
							$info = $event->getMetaFullInfo();							
							$startdate = $info['startdate']['value'] ? $info['startdate']['value'] : '';
							$participants = !empty($info['participants']['value']) ? $info['participants']['value'] : '';
						?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<h3 class="entry-title">
								<span><?php the_title(); ?></span>
							</h3>
							<div class="post-thumbnail">
								<div class="event-single-thumbnail">
									<?php the_post_thumbnail(); ?>		
								</div>							
								<div class="startdate">									
									<span class="day"><?php echo date('d', $startdate); ?></span>
									<span class="month"><?php echo date('M', $startdate); ?></span>
								</div>
							</div>
							<?php if ($startdate): ?>
								<div class="apus-countdown-dark" data-time="timmer"
							        data-date="<?php echo date('m',$startdate).'-'.date('d',$startdate).'-'.date('Y',$startdate).'-'. date('H',$startdate) . '-' . date('i',$startdate) . '-' .  date('s',$startdate) ; ?>">
							    </div>
							<?php endif; ?>
							
							<div class="entry-content"><?php the_content(); ?></div>

							<?php if ( edumy_get_config('show_event_social_share', false) ) { ?>
								<div class="social-share">
									<div class="label"><?php esc_html_e('Share', 'edumy'); ?></div>
		        					<?php get_template_part( 'template-parts/sharebox' ); ?>
		        				</div>
		        			<?php } ?>		       

		        			<div class="envent-participant">
		        				<h4 class="heading"><?php esc_html_e('Event Participants', 'edumy'); ?></h4>
								<?php if ( $participants ) { ?>
									<div class="slick-carousel" data-carousel="slick" data-items="4" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
										<?php foreach ($participants as $value) { ?>
											<div class="participant-item">
												<?php if ( !empty($value['image_id']) ) { ?>
													<div class="image">
														<?php 
															$thumb = edumy_get_attachment_thumbnail($value['image_id'], 'thumbnail');
															echo wp_kses_post($thumb);
														?>
													</div>
												<?php } ?>
												<?php if ( !empty($value['name']) ) { ?>
													<h3 class="name"><?php echo esc_html($value['name']); ?></h3>
												<?php } ?>
												<?php if ( !empty($value['job']) ) { ?>
													<div class="job"><?php echo esc_html($value['job']); ?></div>
												<?php } ?>
											</div>	
										<?php } ?>
									</div>
								<?php } ?>
		        			</div> 																

							<?php
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>
						</article>
					<?php endwhile; ?>

					<?php the_posts_pagination( array(
						'prev_text'          => esc_html__( 'Previous page', 'edumy' ),
						'next_text'          => esc_html__( 'Next page', 'edumy' ),
						'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'edumy' ) . ' </span>',
					) ); ?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
		
		<?php edumy_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>	
</section>
<?php get_footer();