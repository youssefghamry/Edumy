<?php
/**
 * Template for displaying tab nav of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/tabs.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<?php $tabs = learn_press_get_course_tabs(); ?>

<?php if ( empty( $tabs ) ) {
	return;
}

if ( empty( $tabs ) ) {
	return;
}

$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';

if ( ! $active_tab ) {
	$active_tab = learn_press_cookie_get( 'course-tab' );

	if ( ! $active_tab ) {
		$tab_keys   = array_keys( $tabs );
		$active_tab = reset( $tab_keys );
	}
} else {
	$active_tab = str_replace('tab-', '', $active_tab);
}

// Show status course
$lp_user = learn_press_get_current_user();

if ( $lp_user && ! $lp_user instanceof LP_User_Guest ) {
	$can_view_course = $lp_user->can_view_content_course( get_the_ID() );

	if ( ! $can_view_course->flag ) {
		if ( LP_BLOCK_COURSE_FINISHED === $can_view_course->key ) {
			learn_press_display_message(
				esc_html__( 'You finished this course. This course has been blocked', 'edumy' ),
				'warning'
			);
		} elseif ( LP_BLOCK_COURSE_DURATION_EXPIRE === $can_view_course->key ) {
			learn_press_display_message(
				esc_html__( 'This course has been blocked reason by expire', 'edumy' ),
				'warning'
			);
		}
	}
}


if ( edumy_get_config('course_layout_type') !== 'v2' ) {
?>
	<?php foreach ( $tabs as $key => $tab ) { ?>

        <div class="course-tab-panel-<?php echo esc_attr( $key ); ?> course-section-panel" id="<?php echo esc_attr( $tab['id'] ); ?>">
        	<h3 class="section-title"><?php echo esc_html($tab['title']); ?></h3>
			<?php
			if ( apply_filters( 'learn_press_allow_display_tab_section', true, $key, $tab ) ) {
				if ( is_callable( $tab['callback'] ) ) {
					call_user_func( $tab['callback'], $key, $tab );
				} else {
					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/course-tab-content', $key, $tab );
				}
			}
			?>

        </div>

	<?php } ?>
<?php } else {
	echo $active_tab;
?>
	<div id="learn-press-course-tabs" class="course-tabs">

		<?php foreach ( $tabs as $key => $tab ) : ?>
			<input type="radio" name="learn-press-course-tab-radio" id="tab-<?php echo esc_attr($key); ?>-input"
				<?php checked( $active_tab === $key ); ?> value="<?php echo esc_attr($key); ?>"/>
		<?php endforeach; ?>
	    <ul class="learn-press-nav-tabs course-nav-tabs">

	        <?php foreach ( $tabs as $key => $tab ) { ?>

	            <?php $classes = array( 'course-nav course-nav-tab-' . esc_attr( $key ) );
				if ( $active_tab === $key ) {
					$classes[] = 'active default';
				} ?>

	            <li class="<?php echo join( ' ', $classes ); ?>">
	                <a href="?tab=<?php echo esc_attr( $tab['id'] ); ?>"
	                   data-tab="#<?php echo esc_attr( $tab['id'] ); ?>"><?php echo esc_html($tab['title']); ?></a>
	            </li>

			<?php } ?>

	    </ul>
	    <div class="course-tab-panels">
			<?php foreach ( $tabs as $key => $tab ) { ?>

		        <div class="course-tab-panel-<?php echo esc_attr( $key ); ?> course-tab-panel"
		             id="<?php echo esc_attr( $tab['id'] ); ?>">

					<?php
					if ( apply_filters( 'learn_press_allow_display_tab_section', true, $key, $tab ) ) {
						if ( is_callable( $tab['callback'] ) ) {
							call_user_func( $tab['callback'], $key, $tab );
						} else {
							/**
							 * @since 3.0.0
							 */
							do_action( 'learn-press/course-tab-content', $key, $tab );
						}
					}
					?>

		        </div>

			<?php } ?>
		</div>
	</div>
<?php }