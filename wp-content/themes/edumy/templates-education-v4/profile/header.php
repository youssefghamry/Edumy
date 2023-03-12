<?php
/**
 * Template for displaying profile header.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

$profile = LP_Profile::instance();
$user    = $profile->get_user();

if ( ! isset( $user ) ) {
	return;
}
$user_id = $user->get_id();
$info = get_user_meta($user_id, 'apus_edr_info', true);
$bio = $user->get_description();
?>

<header id="learn-press-profile-header">
	<div id="lp-profile-cover">

		<?php do_action( 'learn-press/user-profile-account' ); ?>

		<div class="lp-profile-username">
			<?php echo trim($user->get_display_name()); ?>
		</div>

	    <?php if ( !empty($info['job']) ) { ?>
            <div class="job"><?php echo esc_html($info['job']); ?></div>
        <?php } ?>

	</div>
</header>