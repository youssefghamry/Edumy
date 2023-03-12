<?php

global $post;

if ( ! $course = LP_Global::course() ) {
	return;
}

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$more_info = get_post_meta($post->ID, '_lp_more_info', true);
?>
<div class="course-info-widget">
	<?php if ( !learn_press_is_learning_course() ) { ?>
		<div class="course-price-wrapper">
			<span><?php echo esc_html__('Price','edumy') ?></span>
			<strong><?php LP()->template( 'course' )->courses_loop_item_price(); ?></strong>
		</div>
	<?php } ?>
	<?php learn_press_get_template( 'single-course/buttons.php' ); ?>
	<?php if ( !empty($more_info) ) { ?>
        <div class="more-information"><?php echo wp_kses_post($more_info); ?></div>
    <?php } ?>
</div>
