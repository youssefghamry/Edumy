<?php

defined( 'ABSPATH' ) || exit();


$profile = LP_Profile::instance($instructor->ID);

$user = $profile->get_user();
?>

<div <?php post_class('instructor-grid'); ?>>
    <div class="instructor-grid-inside">
        <!-- instructor thumbnail -->
        <?php
            $image = $user->get_profile_picture();
            if ( $image ) {
                ?>
                <div class="instructor-cover">
                    <a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>">
                        <?php echo wp_kses_post($image); ?>
                    </a>
                </div>
                <?php
            } else {
                ?>
                <div class="instructor-cover no-image">
                    <a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>">
                        
                    </a>
                </div>
                <?php
            }
        ?>
        <h3 class="instructor-name"><a href="<?php echo learn_press_user_profile_link( $instructor->ID ); ?>"><?php echo wp_kses_post($user->get_display_name()); ?></a></h3>
        <?php
            $info = get_user_meta( $instructor->ID, 'apus_edr_info',true );
            if ( !empty($info) && !empty($info['job']) ) {
                ?>
                <div class="job"><?php echo esc_html($info['job']); ?></div>
                <?php
            }
        ?>
    </div>
</div>
