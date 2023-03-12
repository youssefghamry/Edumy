<?php
	$thumbsize = isset($thumbsize) ? $thumbsize : 'full';
	$event = apussimpleevent_event( get_the_ID() );
	$metas = $event->getMetaFullInfo();
	$startdate = isset($metas['startdate']) ? $metas['startdate']['value'] : '';
	$time = isset($metas['time']) ? $metas['time']['value'] : '';
	$address = isset($metas['address']) ? $metas['address']['value'] : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('event-grid'); ?>>
	
	<div class="event-thumb">
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

		<div class="event-metas">
			<?php if ( !empty($time) || !empty($address) ) { ?>
				<div class="time-location">
					<?php if ( !empty($time) ) { ?>
						<div class="event-time">
							<i class="flaticon-calendar"></i> <?php echo esc_html($time); ?>
						</div>
					<?php } ?>
					<?php if ( !empty($address) ) { ?>
						<div class="event-address">
							<i class="flaticon-placeholder"></i> <?php echo esc_html($address); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</div>
	</div>

</article>