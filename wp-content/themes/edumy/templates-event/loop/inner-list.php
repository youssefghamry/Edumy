<?php
	$thumbsize = isset($thumbsize) ? $thumbsize : '600x385';
	$event = apussimpleevent_event( get_the_ID() );
	$metas = $event->getMetaFullInfo();
	$startdate = isset($metas['startdate']) ? $metas['startdate']['value'] : '';
	$finishdate = isset($metas['finishdate']) ? $metas['finishdate']['value'] : '';
	$time = isset($metas['time']) ? $metas['time']['value'] : '';
	$address = isset($metas['address']) ? $metas['address']['value'] : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('event-list'); ?>>
	<div class="event-container event-listing">
		<div class="flex-middle row"> 
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
				<div class="event-post-thumbnail">
					<?php if ( has_post_thumbnail() ) {
						$thumb = edumy_display_post_thumb($thumbsize);
					?>
						<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
							<?php echo wp_kses_post($thumb); ?>
						</a>
					<?php } ?>
					<?php if ( $startdate ) { ?>
						<div class="startdate">
							<span class="day"><?php echo date('d', $startdate); ?></span>
							<span class="month"><?php echo date('M', $startdate); ?></span>
						</div>
					<?php } ?>					
				</div>		
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"> 
				<div class="event-metas">
					<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					<?php if(has_excerpt()){?>
                        <div class="description"><?php echo wp_kses_post(edumy_substring( get_the_excerpt(), 20, '...' )); ?></div>
                    <?php } ?>
					<?php if ( !empty($time) || !empty($address) ) { ?>
						<div class="time-location">
							<?php if ( !empty($startdate) || !empty($finishdate) ) { ?>
								<div class="event-date">
									<i class="flaticon-appointment"></i> 
									<span><?php echo esc_html__('Date:', 'edumy'); ?></span>
									<span class="date">
										<?php if ( !empty($startdate) ) { ?>
											<?php echo date( get_option( 'date_format' ), $startdate); ?>
										<?php } ?>
										<?php if ( !empty($finishdate) ) { ?>
											- <?php echo date( get_option( 'date_format' ), $finishdate); ?>
										<?php } ?>
									</span>
								</div>
							<?php } ?>

							<?php if ( !empty($time) ) { ?>
								<div class="event-time">
									<i class="flaticon-clock"></i> 
									<span><?php echo esc_html__('Time:', 'edumy'); ?></span>
									<?php echo esc_html($time); ?>
								</div>
							<?php } ?>
							<?php if ( !empty($address) ) { ?>
								<div class="event-address">
									<i class="flaticon-placeholder"></i> 
									<span><?php echo esc_html__('Address:', 'edumy'); ?></span>
									<?php echo esc_html($address); ?>
								</div>
							<?php } ?>
							
						</div>
					<?php } ?>		
				</div>
			</div>
		</div>
	</div>
</article>