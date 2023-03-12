<?php

// Course Archive settings
function edumy_learnpress_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-website',
        'title' => esc_html__('Course Settings', 'edumy'),
        'fields' => array(
            array(
                'id' => 'courses_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'courses_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'edumy'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'edumy'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'edumy').'</em>',
                'id' => 'courses_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'courses_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'edumy'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'edumy'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Courses Archives', 'edumy'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'courses_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'courses_display_mode',
                'type' => 'select',
                'title' => esc_html__('Courses Layout', 'edumy'),
                'subtitle' => esc_html__('Choose a default layout archive course.', 'edumy'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'edumy'),
                    'list' => esc_html__('List v1', 'edumy'),
                    'list-v2' => esc_html__('List v2', 'edumy'),
                ),
                'default' => 'grid'
            ),
            array(
                'id' => 'courses_columns',
                'type' => 'select',
                'title' => esc_html__('Course Columns', 'edumy'),
                'options' => $columns,
                'default' => 4,
                'required' => array('courses_display_mode', '=', array('grid'))
            ),
            array(
                'id' => 'number_courses_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Courses Per Page', 'edumy'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'courses_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'courses_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'edumy'),
                'default' => false
            ),
            array(
                'id' => 'courses_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Course Layout', 'edumy'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive course page.', 'edumy'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'edumy'),
                        'alt' => esc_html__('Main Content', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'edumy'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'edumy'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'courses_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'edumy'),
                'options' => $sidebars
            ),
            array(
                'id' => 'courses_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'edumy'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'edumy'),
                'options' => $sidebars
            ),
        )
    );
    
    
    // Course Page
    $sections[] = array(
        'title' => esc_html__('Course Single', 'edumy'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'course_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'course_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'edumy'),
                'default' => false
            ),
            array(
                'id' => 'course_layout_type',
                'type' => 'select',
                'title' => esc_html__('Course Layout', 'edumy'),
                'subtitle' => esc_html__('Choose a default layout single course.', 'edumy'),
                'options' => array(
                    'v1' => esc_html__('Layout 1', 'edumy'),
                    'v2' => esc_html__('Layout 2', 'edumy'),
                    'v3' => esc_html__('Layout 3', 'edumy'),
                ),
                'default' => 'v1'
            ),
            array(
                'id' => 'show_course_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'edumy'),
                'default' => 1
            ),
            array(
                'id' => 'show_course_review_tab',
                'type' => 'switch',
                'title' => esc_html__('Show Course Review Tab', 'edumy'),
                'default' => 1
            ),
            array(
                'id' => 'course_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'course_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Course Sidebar Layout', 'edumy'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Course Page.', 'edumy'),
                'options' => array(
                    'left-main' => array(
                        'title' => esc_html__('Left - Main Sidebar', 'edumy'),
                        'alt' => esc_html__('Left - Main Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main - Right Sidebar', 'edumy'),
                        'alt' => esc_html__('Main - Right Sidebar', 'edumy'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'main-right'
            ),
            array(
                'id' => 'course_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Course Block Setting', 'edumy').'</h3>',
            ),
            array(
                'id' => 'show_course_releated',
                'type' => 'switch',
                'title' => esc_html__('Show Courses Releated', 'edumy'),
                'default' => 1
            ),
            array(
                'id' => 'number_course_releated',
                'title' => esc_html__('Number of related courses to show', 'edumy'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '50',
                'type' => 'slider',
                'required' => array('show_course_releated', '=', true)
            ),
            array(
                'id' => 'releated_course_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Courses Columns', 'edumy'),
                'options' => $columns,
                'default' => 4,
                'required' => array('show_course_releated', '=', true)
            ),

        )
    );
    
    return $sections;
}
add_filter( 'edumy_redux_framwork_configs', 'edumy_learnpress_redux_config', 15, 3 );