<?php


remove_all_actions( 'learn-press/course-content-summary', 10 );
remove_all_actions( 'learn-press/course-content-summary', 15 );
remove_all_actions( 'learn-press/course-content-summary', 35 );
remove_all_actions( 'learn-press/course-content-summary', 30 );
remove_all_actions( 'learn-press/course-content-summary', 100 );

remove_action( 'learn-press/before-main-content', LP()->template( 'general' )->func( 'breadcrumb' ) );

remove_all_actions( 'learn-press/after-courses-loop', 10 );

function edumy_learnpress_v4_single_course_action() {
    
    add_action( 'learn-press/course-content-summary', 'edumy_single_course_video', 17 );

    if ( edumy_get_config('course_layout_type') !== 'v3' ) {
        add_action( 'learn-press/course-content-summary', 'edumy_single_course_heading', 10 );
    } else {
        add_action( 'edumy_single_course_header', 'edumy_single_course_heading', 10 );
    }

    add_action(
        'learn-press/course-content-summary',
        LP()->template( 'course' )->text( '<div class="lp-entry-content d-block apus-lp-content-area">', 'lp-entry-content-open' ),
        30
    );
}
add_action( 'init', 'edumy_learnpress_v4_single_course_action' );
