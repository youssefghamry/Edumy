<?php
/**
 * Template for displaying user's BIO in profile.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

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
