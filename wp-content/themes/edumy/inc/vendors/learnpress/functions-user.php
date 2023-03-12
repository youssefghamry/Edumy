<?php

function edumy_user_profile_fields( $user ) {
	$user_info = get_the_author_meta( 'apus_edr_info', $user->ID );
	?>
	<h3><?php esc_html_e( 'Instructor Profile', 'edumy' ); ?></h3>

	<table class="form-table">
		<tbody>
		<tr>
			<th>
				<label for="instructor_job"><?php esc_html_e( 'Job', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_job" class="regular-text" type="text" value="<?php echo isset( $user_info['job'] ) ? $user_info['job'] : ''; ?>" name="apus_edr_info[job]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_mobile"><?php esc_html_e( 'Mobile', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_mobile" class="regular-text" type="text" value="<?php echo isset( $user_info['mobile'] ) ? $user_info['mobile'] : ''; ?>" name="apus_edr_info[mobile]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_facebook"><?php esc_html_e( 'Facebook Account', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_facebook" class="regular-text" type="text" value="<?php echo isset( $user_info['facebook'] ) ? $user_info['facebook'] : ''; ?>" name="apus_edr_info[facebook]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_twitter"><?php esc_html_e( 'Twitter Account', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_twitter" class="regular-text" type="text" value="<?php echo isset( $user_info['twitter'] ) ? $user_info['twitter'] : ''; ?>" name="apus_edr_info[twitter]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_google"><?php esc_html_e( 'Google Plus Account', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_google" class="regular-text" type="text" value="<?php echo isset( $user_info['google'] ) ? $user_info['google'] : ''; ?>" name="apus_edr_info[google]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_linkedin"><?php esc_html_e( 'LinkedIn Plus Account', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_linkedin" class="regular-text" type="text" value="<?php echo isset( $user_info['linkedin'] ) ? $user_info['linkedin'] : ''; ?>" name="apus_edr_info[linkedin]">
			</td>
		</tr>
		<tr>
			<th>
				<label for="instructor_youtube"><?php esc_html_e( 'Youtube Account', 'edumy' ); ?></label>
			</th>
			<td>
				<input id="instructor_youtube" class="regular-text" type="text" value="<?php echo isset( $user_info['youtube'] ) ? $user_info['youtube'] : ''; ?>" name="apus_edr_info[youtube]">
			</td>
		</tr>
		</tbody>
	</table>

	<!-- Education -->
	<?php $apus_edr_education = get_the_author_meta( 'apus_edr_education', $user->ID );?>

	<h3><?php esc_html_e( 'Instructor Education', 'edumy' ); ?></h3>
	<table class="form-table instructor-education">
		<tbody>
			<?php
				if ( isset($apus_edr_education['school']) &&  count($apus_edr_education['school']) > 0 ) {
					$number = count($apus_edr_education['school']);
				} else {
					$number = 1;
				}
				for ($i=0; $i < $number; $i++) {
					?>
					<tr>
						<th>
							<label><?php esc_html_e( 'School', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_education['school'][$i] ) ? $apus_edr_education['school'][$i] : ''; ?>" name="apus_edr_education[school][]">
							<br>
							<i><?php esc_html_e( 'Ex: Education', 'edumy' ); ?></i>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Date', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_education['date'][$i] ) ? $apus_edr_education['date'][$i] : ''; ?>" name="apus_edr_education[date][]">
							<br>
							<i><?php esc_html_e( 'Ex: 2015 - 2019', 'edumy' ); ?></i>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Description', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_education['description'][$i] ) ? $apus_edr_education['description'][$i] : ''; ?>" name="apus_edr_education[description][]">
							<br>
							<i><?php esc_html_e( 'Ex: 12 Years', 'edumy' ); ?></i>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>
					<button class="add-new-education button button-primary"><?php esc_html_e( 'Add New Education', 'edumy' ); ?></button>
				</th>
				<td>
					<button class="remove-education button"><?php esc_html_e( 'Remove Education', 'edumy' ); ?></button>
				</td>
			</tr>
		</tfoot>
	</table>

	<!-- Experience -->
	<?php $apus_edr_experience = get_the_author_meta( 'apus_edr_experience', $user->ID );?>
	<h3><?php esc_html_e( 'Instructor Experience', 'edumy' ); ?></h3>
	<table class="form-table instructor-experience">
		<tbody>
			<?php
				if ( isset($apus_edr_experience['company']) &&  count($apus_edr_experience['company']) > 0 ) {
					$number = count($apus_edr_experience['company']);
				} else {
					$number = 1;
				}
				for ($i=0; $i < $number; $i++) {
					?>
					<tr>
						<th>
							<label><?php esc_html_e( 'Company', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_experience['company'][$i] ) ? $apus_edr_experience['company'][$i] : ''; ?>" name="apus_edr_experience[company][]">
							<br>
							<i><?php esc_html_e( 'Ex: Google', 'edumy' ); ?></i>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Date', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_experience['date'][$i] ) ? $apus_edr_experience['date'][$i] : ''; ?>" name="apus_edr_experience[date][]">
							<br>
							<i><?php esc_html_e( 'Ex: 2015 - 2019', 'edumy' ); ?></i>
						</td>
					</tr>
					<tr>
						<th>
							<label><?php esc_html_e( 'Job', 'edumy' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo isset( $apus_edr_experience['job'][$i] ) ? $apus_edr_experience['job'][$i] : ''; ?>" name="apus_edr_experience[job][]">
							<br>
							<i><?php esc_html_e( 'Ex: Web Designer', 'edumy' ); ?></i>
						</td>
					</tr>
					<?php
				}
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>
					<button class="add-new-experience button button-primary"><?php esc_html_e( 'Add New Experience', 'edumy' ); ?></button>
				</th>
				<td>
					<button class="remove-experience button"><?php esc_html_e( 'Remove Experience', 'edumy' ); ?></button>
				</td>
			</tr>
		</tfoot>
	</table>
	<?php
}
add_action( 'show_user_profile', 'edumy_user_profile_fields' );
add_action( 'edit_user_profile', 'edumy_user_profile_fields' );

function edumy_save_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}
	update_user_meta( $user_id, 'apus_edr_info', $_POST['apus_edr_info'] );
	update_user_meta( $user_id, 'apus_edr_experience', $_POST['apus_edr_experience'] );
	update_user_meta( $user_id, 'apus_edr_education', $_POST['apus_edr_education'] );
}

add_action( 'personal_options_update', 'edumy_save_user_profile_fields' );
add_action( 'edit_user_profile_update', 'edumy_save_user_profile_fields' );

function edumy_add_scripts() {
	wp_enqueue_script( 'edumy-user-admin', get_template_directory_uri() . '/js/user-admin.js', array( 'jquery' ), '20150315', true );
}
add_action( 'admin_enqueue_scripts', 'edumy_add_scripts' );

function edumy_learnpress_get_instructors($number = -1) {
	$roles = array( 'administrator', 'instructor' );
	$users_by_role = get_users( array( 'role__in' => $roles, 'number' => $number ) );
	return $users_by_role;
}

function edumy_get_instructors_by_ids( $args = array() ) {
	$wp_user_query = new WP_User_Query( array( 'include' => $args ) );
	return $wp_user_query->get_results();
}
