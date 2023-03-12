<?php

global $post;

if ( empty($post->post_type) || $post->post_type != 'simple_event' ) {
	return;
}

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$event = apussimpleevent_event( $post->ID );
$info = $event->getMetaFullInfo();

$startdate = $info['startdate']['value'] ? $info['startdate']['value'] : '';
$finishdate = $info['finishdate']['value'] ? $info['finishdate']['value'] : '';
$time = $info['time']['value'] ? $info['time']['value'] : '';
$address = $info['address']['value'] ? $info['address']['value'] : '';
?>
<div class="event-detail-widget">
	<ul class="list">
        <?php if ( $startdate || $finishdate ) { ?>
            <li class="event-detail-date">
                <div class="icon-wrapper">
                    <i class="flaticon-appointment"></i>
                </div>
                <div class="content">
                    <label><?php esc_html_e( 'Date:', 'edumy' ); ?></label>
        			<span class="startdate">
                        <?php if ( $startdate ) { ?>
                            <?php echo date(get_option('date_format'), $startdate); ?>
                        <?php } ?>
                        <?php if ( $finishdate ) { ?>
                            - <?php echo date(get_option('date_format'), $finishdate); ?>
                        <?php } ?>
                    </span>
                </div>
            </li>
        <?php } ?>
        <?php if ( $time ) { ?>
            <li class="event-detail-time">
                <div class="icon-wrapper">
                    <i class="flaticon-clock"></i>
                </div>
                <div class="content">
                    <label><?php esc_html_e( 'Time:', 'edumy' ); ?></label>
                    <span class="startdate"><?php echo esc_html($time); ?></span>
                </div>
            </li>
        <?php } ?>
        <?php if ( $address ) { ?>
            <li class="event-detail-address">
                <div class="icon-wrapper">
                    <i class="flaticon-placeholder"></i>
                </div>
                <div class="content">
                    <label><?php esc_html_e( 'Address:', 'edumy' ); ?></label>
                    <span class="startdate"><?php echo esc_html($address); ?></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
