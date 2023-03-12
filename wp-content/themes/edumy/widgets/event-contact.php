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
$phone = $info['phone']['value'] ? $info['phone']['value'] : '';
$email = $info['email']['value'] ? $info['email']['value'] : '';
$website = $info['website']['value'] ? $info['website']['value'] : '';

$map = $info['map']['value'];
?>
<div class="event-detail-widget">
    <div id="event-contact-maps" class="maps" data-latitude="<?php echo esc_attr($map['latitude']); ?>" data-longitude="<?php echo esc_attr($map['longitude']); ?>" style="width: 100%; height: 300px;"></div>
	<ul class="list">
        <?php if ( $phone ) { ?>
            <li>
                <i class="flaticon-phone-call"></i>
                <a href="tel:<?php echo trim($phone); ?>"><?php echo esc_html($phone); ?></a>                
            </li>
        <?php } ?>
        <?php if ( $email ) { ?>
            <li>
                <i class="flaticon-email"></i>
                <a href="mailto:<?php echo trim($email); ?>"><?php echo esc_html($email); ?></a>
            </li>
        <?php } ?>
        <?php if ( $website ) { ?>
            <li>
                <i class="flaticon-www"></i>
                <a href="<?php echo esc_url($website); ?>"><?php echo esc_html($website); ?></a>
            </li>
        <?php } ?>
    </ul>
</div>
