<?php

extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$profile = LP_Global::profile();
$user = LP_Profile::instance()->get_user();
$user_id = $user->get_id();
$info = get_user_meta($user_id, 'apus_edr_info', true);
$user_info = get_userdata($user_id);
?>
<div class="profile-info-widget">
	<?php if ( !empty($info['mobile']) ) { ?>
		<div class="profile-item phome">
			<div class="label"><?php esc_html_e('Phone Number', 'edumy'); ?></div>
			<div class="value"><a href="tel:<?php echo trim($info['mobile']); ?>"><?php echo esc_html($info['mobile']); ?></a></div>
		</div>
	<?php } ?>
	<?php if ( !empty($user_info->user_email) ) { ?>
		<div class="profile-item email">
			<div class="label"><?php esc_html_e('Email', 'edumy'); ?></div>
			<div class="value"><a href="mailto:<?php echo trim($user_info->user_email); ?>"><?php echo esc_html($user_info->user_email); ?></a></div>
		</div>
	<?php } ?>
	<?php if ( !empty($user_info->user_url) ) { ?>
		<div class="profile-item website">
			<div class="label"><?php esc_html_e('Website', 'edumy'); ?></div>
			<div class="value"><a href="<?php echo esc_html($user_info->user_url); ?>"><?php echo esc_html($user_info->user_url); ?></a></div>
		</div>
	<?php } ?>

	<!-- socials -->
	<?php if ( !empty($info['facebook']) || !empty($info['twitter']) || !empty($info['google']) || !empty($info['linkedin']) || !empty($info['youtube']) ) { ?>
		<div class="socials-title"><?php esc_html_e('Socials Media', 'edumy'); ?></div>
		<ul class="socials">
			<?php if ( !empty($info['facebook']) ) { ?>
				<li><a href="<?php echo esc_url($info['facebook']); ?>"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if ( !empty($info['twitter']) ) { ?>
				<li><a href="<?php echo esc_url($info['twitter']); ?>"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if ( !empty($info['google']) ) { ?>
				<li><a href="<?php echo esc_url($info['google']); ?>"><i class="fa fa-google"></i></a></li>
			<?php } ?>
			<?php if ( !empty($info['linkedin']) ) { ?>
				<li><a href="<?php echo esc_url($info['linkedin']); ?>"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php if ( !empty($info['youtube']) ) { ?>
				<li><a href="<?php echo esc_url($info['youtube']); ?>"><i class="fa fa-youtube"></i></a></li>
			<?php } ?>
		</ul>
	<?php } ?>
</div>
