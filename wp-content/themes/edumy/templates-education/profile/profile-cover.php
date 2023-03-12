<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

$user = $profile->get_user();
$user_id = $user->get_id();
$info = get_user_meta($user_id, 'apus_edr_info', true);
$image = $user->get_profile_picture();
?>

<div id="learn-press-profile-header" class="lp-profile-header">
    <div class="lp-profile-cover">
        <div class="lp-profile-avatar">
            <div class="instructor-cover">
                <?php echo wp_kses_post($image); ?>
            </div>
            <h2 class="profile-name"><?php echo esc_html($user->get_display_name()); ?></h2>
            <?php if ( !empty($info['job']) ) { ?>
	            <div class="job"><?php echo esc_html($info['job']); ?></div>
	        <?php } ?>

        </div>
    </div>
</div>