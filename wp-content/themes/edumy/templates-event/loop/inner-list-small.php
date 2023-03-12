<?php
	$event = apussimpleevent_event( get_the_ID() );
	$metas = $event->getMetaFullInfo();
	$startdate = isset($metas['startdate']) ? $metas['startdate']['value'] : '';
	$time = isset($metas['time']) ? $metas['time']['value'] : '';
	$address = isset($metas['address']) ? $metas['address']['value'] : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('event-list-small'); ?>>
	<div class="event-container event-listing">
		<div class="flex-middle row"> 
			
			<div class="event-post-date">
				<?php if ( $startdate ) { ?>
					<div class="startdate">
						<span class="day"><?php echo date('d', $startdate); ?></span>
						<span class="month"><?php echo date('M', $startdate); ?></span>
					</div>
				<?php } ?>				
			</div>

				<div class="event-metas">
					<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
					

					<?php if ( !empty($time) || !empty($address) ) { ?>
						<div class="time-location">
							
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
</article>