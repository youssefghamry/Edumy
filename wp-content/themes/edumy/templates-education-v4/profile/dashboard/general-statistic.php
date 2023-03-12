<?php
/**
 * Template for displaying general statistic in user profile overview.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( empty( $statistic ) ) {
	return;
}

$user = LP_Profile::instance()->get_user();
?>

<div id="dashboard-general-statistic" class="hidden">

	<?php do_action( 'learn-press/before-profile-dashboard-general-statistic-row' ); ?>

	<div class="dashboard-general-statistic__row">

		<?php do_action( 'learn-press/before-profile-dashboard-user-general-statistic' ); ?>

		<div class="statistic-box">
			<p class="statistic-box__text"><?php esc_html_e( 'Enrolled Courses', 'edumy' ); ?></p>
			<span class="statistic-box__number"><?php echo trim($statistic['enrolled_courses']); ?></span>
		</div>
		<div class="statistic-box">
			<p class="statistic-box__text"><?php esc_html_e( 'Active Courses', 'edumy' ); ?></p>
			<span class="statistic-box__number"><?php echo trim($statistic['active_courses']); ?></span>
		</div>
		<div class="statistic-box">
			<p class="statistic-box__text"><?php esc_html_e( 'Completed Courses', 'edumy' ); ?></p>
			<span class="statistic-box__number"><?php echo trim($statistic['completed_courses']); ?></span>
		</div>

		<?php do_action( 'learn-press/after-profile-dashboard-user-general-statistic' ); ?>
	</div>

	<?php do_action( 'learn-press/profile-dashboard-general-statistic-row' ); ?>

	<?php if ( $user->can_create_course() ) : ?>

		<div class="dashboard-general-statistic__row">

			<?php do_action( 'learn-press/before-profile-dashboard-instructor-general-statistic' ); ?>
			<div class="statistic-box">
				<p class="statistic-box__text"><?php esc_html_e( 'Total Courses', 'edumy' ); ?></p>
				<span class="statistic-box__number"><?php print_r( $statistic['total_courses'] ); ?></span>
			</div>
			<div class="statistic-box">
				<p class="statistic-box__text"><?php esc_html_e( 'Total Students', 'edumy' ); ?></p>
				<span class="statistic-box__number"><?php echo trim($statistic['total_users']); ?></span>
			</div>

			<?php do_action( 'learn-press/after-profile-dashboard-instructor-general-statistic' ); ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'learn-press/after-profile-dashboard-general-statistic-row' ); ?>
</div>


<?php
$user = LP_Profile::instance()->get_user();

$user_id = $user->get_id();
$education = get_user_meta($user_id, 'apus_edr_education', true);
$experience = get_user_meta($user_id, 'apus_edr_experience', true);

?>
<div class="user-bio">
	<div class="user-bio-description">
		<?php echo wp_kses_post($user->get_description()); ?>
	</div>
	<div class="section">
		<h3 class="section-title"><?php esc_html_e('Education', 'edumy'); ?></h3>
		<?php if ( !empty($education['school']) ) { ?>
			<ul class="list-education">
				<?php foreach ($education['school'] as $key => $school) { ?>
					<?php if ( !empty($school) ) { ?>
						<li>
							<div class="list-education-info">
								<h4 class="title"><?php echo esc_html($school); ?></h4>
								<?php if ( !empty($education['date'][$key]) ) { ?>
									<div class="date"><?php echo esc_html($education['date'][$key]); ?></div>
								<?php } ?>
							</div>							

							<?php if ( !empty($education['description'][$key]) ) { ?>
								<div class="description"><?php echo esc_html($education['description'][$key]); ?></div>
							<?php } ?>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
	<div class="section">
		<h3 class="section-title"><?php esc_html_e('Experience', 'edumy'); ?></h3>
		<?php if ( !empty($experience['company']) ) { ?>
			<ul class="list-experience">
				<?php foreach ($experience['company'] as $key => $company) { ?>
					<?php if ( !empty($company) ) { ?>
						<li>
							<div class="list-experience-info">
								<h4 class="title"><?php echo esc_html($company); ?></h4>
								<?php if ( !empty($experience['date'][$key]) ) { ?>
									<div class="date"><?php echo esc_html($experience['date'][$key]); ?></div>
								<?php } ?>								
							</div>

							<?php if ( !empty($experience['job'][$key]) ) { ?>
								<div class="job"><?php echo esc_html($experience['job'][$key]); ?></div>
							<?php } ?>
						</li>
					<?php } ?>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
</div>
